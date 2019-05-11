<?php
namespace Rojo\Dice;

class Player
{
    private $name;
    private $hand;
    private $score = 0;

    /**
     * Constructor to create a Player.
     *
     * @param int    $sides number of sides on dice
     * @param string    $name of player
     */
    public function __construct(string $name = "Player", int $dices = 2)
    {
        $this->hand = new DiceHand($dices);
        $this->name = $name;
    }

    /**
     * Roll the dice/dices
     *
     * @return bool as successfull roll.
     */
    public function roll()
    {
        $this->hand->roll();
        $values = $this->hand->values();

        for ($i=0; $i < sizeof($values); $i++) {
            if ($values[$i] == 1) {
                return true;
            }
        }
        $this->score += $this->hand->sum();
        return false;
    }

    /**
     * Roll the dice/dices
     *
     * @return int Players score
     */

    public function getScore()
    {
        return $this->score;
    }

    /**
     * get name
     *
     * @return string Players name
     */

    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets new score
     *
     * @param int    New score
     *
     * @return void
     */

    public function setScore($newScore)
    {
        $this->score = $newScore;
    }

    /**
     * Return players hand
     *
     * @return object DiceHand
     */

    public function getHand()
    {
        return $this->hand;
    }
}
