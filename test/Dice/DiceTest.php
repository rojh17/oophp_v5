<?php

namespace Rojo\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testDice()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Rojo\Dice\Dice", $dice);

        $res = $dice->rollDice();
        $this->assertEquals(($res > 0 && $res < 7), $res);

        $res = $dice->getLastRoll();
        $this->assertEquals(($res > 0 && $res < 7), $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testDiceHand()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Rojo\Dice\DiceHand", $dicehand);

        $dicehand->roll();
        $res = $dicehand->sum();
        $this->assertEquals(($res > 5 && $res < 31), $res);

        $res = $dicehand->dices();
        $exp = 5;
        $this->assertEquals($exp, sizeof($res));

        $res = $dicehand->average();
        $this->assertEquals(($res > 0), $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testDiceGraphics()
    {
        $diceGraphics = new DiceGraphic();
        $this->assertInstanceOf("\Rojo\Dice\DiceGraphic", $diceGraphics);

        $res = $diceGraphics->rollDice();
        $this->assertEquals(($res > 0 && $res < 7), $res);

        $res = $diceGraphics->getLastRoll();
        $this->assertEquals(($res > 0 && $res < 7), $res);

        $res = $diceGraphics->graphic();
        $exp = "dice-" . $diceGraphics->getLastRoll();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testPlayer()
    {
        $player = new Player("Roy", 1);
        $this->assertInstanceOf("\Rojo\Dice\Player", $player);

        $res = $player->getScore();
        $this->assertEquals(0, $res);

        $res = $player->getName();
        $this->assertEquals("Roy", $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testComputer()
    {
        $computer = new Computer("Computer", 1);
        $this->assertInstanceOf("\Rojo\Dice\Computer", $computer);

        $computer->setScoreLimit(21);
        $res = $computer->getScoreLimit();
        $exp = 21;
        $this->assertEquals($exp, $res);

        $computer->setTries(2);
        $res = $computer->getTries();
        $exp = 2;
        $this->assertEquals($exp, $res);

        $res = $computer->getScore();
        $this->assertEquals(0, $res);


        $res = $computer->getName();
        $this->assertEquals("Computer", $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGame()
    {

        $game = new game();
        $this->assertInstanceOf("\Rojo\Dice\Game", $game);
        $res = $game->getNumberOfPlayers();
        $exp = 2;
        $this->assertEquals($exp, $res);

        $game = new game(2, 2);
        $this->assertInstanceOf("\Rojo\Dice\Game", $game);
        $res = $game->getNumberOfPlayers();
        $exp = 2;
        $this->assertEquals($exp, $res);

        $game = new game(1, 2);
        $this->assertInstanceOf("\Rojo\Dice\Game", $game);
        $res = $game->getNumberOfPlayers();
        $exp = 2;
        $this->assertEquals($exp, $res);

        $game = new game(1, 2);

        $res = $game->getTurn();
        $this->assertEquals(0, $res);

        $res = $game->getTurn();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $game->next();
        $res = $game->getTurn();
        $this->assertEquals(1, $res);

        $res = $game->roll();
        $this->assertEquals(true, $res);

        $res = $game->next();
        $this->assertEquals(true, $res);

        $player = $game->getPlayer(0);
        $res = $player->getName();
        $exp = "Player 1";
        $this->assertEquals($exp, $res);

        $player = $game->getPlayer(0);
        $this->assertInstanceOf("\Rojo\Dice\Player", $player);

        $player = $game->getPlayer(1);
        $this->assertInstanceOf("\Rojo\Dice\Computer", $player);

        $res = $game->getWinner();
        $exp = "";
        $this->assertEquals($exp, $res);

        $game = new game(2, 2);
        $this->assertInstanceOf("\Rojo\Dice\Game", $game);

        $game->next();
        $player = $game->getPlayer(1);
        $res = $player->getName();
        $exp = "Player 2";
        $this->assertEquals($exp, $res);
    }
}
