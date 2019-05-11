<?php
namespace Rojo\Dice;

class Computer extends Player
{
    private $numberOfTries = 3;
    private $acceptedScore = 20;
     /**
      * Constructor to initiate the computer with name and dices
      */
    public function __construct(string $name = "", int $dices = 2)
    {
        parent::__construct($name, $dices);
    }

    /**
     * Roll the dice/dices
     *
     * @return bool as successfull roll.
     */
    public function roll()
    {
        $tries = 1;
        $res;
        $oldScore = parent::getScore();

        while (true) {
            if (parent::roll()) {
                $res = true;
                break;
            }

            if (parent::getScore() >= 100) {
                // Winner reached 100
                $res = false;
                break;
            } elseif ($tries == $this->numberOfTries) {
                // Number of tries reached
                $res = false;
                break;
            } elseif ((parent::getScore() - $oldScore) > $this->acceptedScore) {
                // Score reached
                $res = false;
                break;
            }

            $tries++;
        }
        return $res;
    }

    /**
     * Sets new score
     *
     * @param int    New score
     *
     * @return void
     */
    public function setTries($num)
    {
        $this->numberOfTries = $num;
    }

    /**
     * Sets new score limit
     *
     * @param int    New score
     *
     * @return void
     */
    public function setScoreLimit($num)
    {
        $this->acceptedScore = $num;
    }

    /**
     * Get number of tries
     *
     * @return int tries
     */
    public function getTries()
    {
        return $this->numberOfTries;
    }

    /**
     * Get limit
     *
     * @return int limit
     */
    public function getScoreLimit()
    {
        return $this->acceptedScore;
    }
}
