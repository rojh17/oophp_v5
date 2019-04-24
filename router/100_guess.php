<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init
 */
$app->router->get("guess/init", function () use ($app) {
    // Init
    if (!isset($_SESSION["game"])) {
        $_SESSION["game"] = serialize(new Rojo\Guess\Guess());
    }
    return $app->response->redirect("guess/play");
});



/**
 * Play
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";
    $tries = $_SESSION["tries"] ?? null;
    $message = $_SESSION["message"] ?? null;

    $data = [
        "tries" => $tries,
        "message" => $message,
    ];

    $app->page->add("guess/play", $data);
    //$app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play
 */
$app->router->post("guess/play", function () use ($app) {


    $game = unserialize($_SESSION["game"]);

    $number = $_POST["number"] ?? null;
    $guess = $_POST["guess"] ?? null;
    $init = $_POST["init"] ?? null;
    $cheat = $_POST["cheat"] ?? null;

    if ($init) {
        $_SESSION["game"] = serialize(new Rojo\Guess\Guess());
        $_SESSION["message"] = "";
        $game = unserialize($_SESSION["game"]);
    }

    if ($guess) {
        $_SESSION["message"] = $game->makeGuess($number);
        $_SESSION["game"] = serialize($game);
    }

    if ($cheat) {
        $_SESSION["message"] = "The number is: {$game->number()}";
    }

    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("guess/play");
});
