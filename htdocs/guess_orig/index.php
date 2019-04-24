<?php
/**
 * Main
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

$message = "";

if (!isset($_SESSION["game"])) {
    $_SESSION["game"] = serialize(new Guess());
}

//var_dump($_SESSION);
$game = unserialize($_SESSION["game"]);

//var_dump($game);

$number = $_POST["number"] ?? null;
$guess = $_POST["guess"] ?? null;
$init = $_POST["init"] ?? null;
$cheat = $_POST["cheat"] ?? null;

if ($init) {
    $_SESSION["game"] = serialize(new Guess());
    $game = unserialize($_SESSION["game"]);
}

if ($guess) {
    $message = $game->makeGuess($number);
    $_SESSION["game"] = serialize($game);
}

if ($cheat) {
    $message = "The number is: {$game->number()}";
}

$tries = $game->tries();

//$_SESSION["game"] = $game;

// Render the game
include(__DIR__ . "./view/gameview.php");
