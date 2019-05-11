<?php
namespace Rojo\Dice;

class Dice
{
    private $sides;
    private $lastRoll;

    /**
     * Constructor to create a Dice.
     *
     * @param int    $sides number of sides on dice
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    /**
     * Roll the dice/dices
     *
     * @return int Roll the dice and return it
     */
    public function rollDice()
    {
        $this->lastRoll =  rand(1, $this->sides);
        return $this->lastRoll;
    }

    /**
     * Get last roll
     *
     * @return int Last roll
     */
    public function getLastRoll()
    {
        return $this->lastRoll;
    }
}
