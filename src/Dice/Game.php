<?php
namespace Rojo\Dice;

class Game
{
    private $numberOfPlayers;
    private $playersTurn = 0;
    private $player;
    private $score;
    private $winner = " ";

    /**
     * Constructor to create a Game.
     *
     * @param int    $dices number of sides on dice
     * @param int    $numberOfPlayers number of players
     */
    public function __construct(int $numberOfPlayers = 1, int $dices = 2)
    {
        if ($numberOfPlayers < 2) {
            $this->numberOfPlayers = $numberOfPlayers + 1;
            $this->playersTurn = 0;
            $this->winner = "";

            $this->player[0] = new Player("Player 1", $dices);
            $this->player[1] = new Computer("Computer", $dices);
        } else {
            $this->numberOfPlayers = $numberOfPlayers;
            $this->playersTurn = 0;
            $this->winner = "";

            for ($i=0; $i < ($this->numberOfPlayers); $i++) {
                $this->player[$i]  = new Player("Player ". ($i + 1), $dices);
                $this->score[$i] = 0;
            }
        }
    }

    /**
     * Roll the dice/dices
     *
     * @return void roll the dice in placers hand
     */
    public function roll()
    {
        $oldScore = $this->player[$this->playersTurn]->getScore();
        $next = $this->player[$this->playersTurn]->roll();

        if ($next) {
            $this->player[$this->playersTurn]->setScore($oldScore);
            $this->next();
        }

        return true;
    }

    /**
     * Switch to next player
     *
     * @return void Switch player
     */
    public function next()
    {
        if ($this->playersTurn < ($this->numberOfPlayers - 1)) {
            $this->playersTurn++;
        } else {
            $this->playersTurn--;
        }
        return true;
    }
    /**
     * Get players turn
     *
     * @return int Players turn
     */
    public function getTurn()
    {
        return $this->playersTurn;
    }

    public function getPlayer($num)
    {
        return $this->player[$num];
    }

    /**
     * Get players score
     *
     * @return int Score
     */
    public function getScore()
    {
        // $this->score[0] = $this->player[0]->getScore();
        // $this->score[1] = $this->player[1]->getScore();
        $scores;

        for ($i=0; $i < sizeof($this->player); $i++) {
            $scores[$this->player[$i]->getName()] = $this->player[$i]->getScore();
        }

        return $scores;
    }

    /**
     * Get class-name for graphics
     *
     * @return string classname
     */
    public function getGraphics()
    {
        $graphics;
        $var = $this->player[$this->playersTurn]->getHand()->dices();

        for ($i=0; $i < sizeof($var); $i++) {
            $graphics[] = $var[$i]->graphic();
        }

        return $graphics;
    }

    /**
     * Get the winner
     *
     * @return int Player id
     */
    public function getWinner()
    {
        $score;

        for ($i=0; $i < $this->numberOfPlayers; $i++) {
            $score = $this->player[$i]->getScore();
            if ($score >= 100) {
                $this->winner = "The winner is player " . ($i + 1);
                break;
            }
        }

        return $this->winner;
    }

    /**
     * Get players
     *
     * @return int Number of players
     */
    public function getNumberOfPlayers()
    {

        return sizeof($this->player);
    }
}
