<?php
namespace Rojo\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{

    private $dices;
    private $values;
    private $sum = 0;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct(int $dices = 5)
    {
        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = new DiceGraphic();
            $this->values[] = null;
        }
    }

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        $this->sum = 0;

        for ($i=0; $i < sizeof($this->dices); $i++) {
            $this->values[$i] = $this->dices[$i]->rollDice();
            $this->sum += $this->values[$i];
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function dices()
    {
        return $this->dices;
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        return $this->sum;
    }
    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */
    public function average()
    {
        $sum = 0;

        for ($i=0; $i < sizeof($this->values); $i++) {
            $sum += $this->values[$i];
        }
        return $sum / sizeof($this->values);
    }
}
