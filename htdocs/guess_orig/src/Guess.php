<?php
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     * @var int $completed    True if user guessed correct.
     */

    private $number;
    private $tries;
    private $completed;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     * @param bool $completed True if user guessed correct.
     *                    default false.
     */

    public function __construct(int $number = -1, int $tries = 6, bool $completed = false)
    {
        if ($number == -1) {
            $this->number = $this->random();
        }

        $this->tries = $tries;

        $this->completed = $completed;
    }




    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        return rand(1, 100);
    }




    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return $this->tries;
    }




    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }




    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */

    public function makeGuess($number)
    {
        if ($number > 100 || $number < 1) {
            throw new GuessException("Number is out of bounds. Enter number between 1-100");
        }

        if (($this->tries > 0) && ($this->completed == false)) {
            $this->tries--;

            if ($number < $this->number) {
                return "Your guess {$number} is to Low";
            } elseif ($number == $this->number) {
                $this->completed = true;
                return "Your guess {$number} is Correct";
            } elseif ($number > $this->number) {
                return "Your guess {$number} is to High";
            }
        } elseif ($this->completed == true) {
            return "You won! Reset the game to play again";
        } else {
            return "No more tries, you loose. Reset the game to play again";
        }
    }
}
