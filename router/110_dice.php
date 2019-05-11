<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init
 */
$app->router->get("dice/init", function () use ($app) {
    // Init
    if (!isset($_SESSION["dicegame"])) {
        $_SESSION["dicegame"] = serialize(new Rojo\Dice\Game(1));
    }

    if (!isset($_SESSION["dices"])) {
        $_SESSION["dices"] = 2;
    }

    return $app->response->redirect("dice/play");
});



/**
 * Play
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Play the game";

    $game = unserialize($_SESSION["dicegame"]);


    $data = [
        "player" => $game->getTurn() + 1,
        "score" => $game->getScore(),
        "message" => $game->getWinner(),
        "dices" => $_SESSION["dices"],
        "graphics" => $game->getGraphics()
    ];

    $app->page->add("dice/play", $data);
    //$app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play
 */
$app->router->post("dice/play", function () use ($app) {


    $game = unserialize($_SESSION["dicegame"]);

    $dices = $_POST["number"] ?? 1;
    $roll = $_POST["roll"] ?? null;
    $stop = $_POST["stop"] ?? null;
    $init = $_POST["init"] ?? null;

    $_SESSION["dices"] = $dices;

    if ($init) {
        $_SESSION["dicegame"] = serialize(new Rojo\Dice\Game(1, $dices));
        $game = unserialize($_SESSION["dicegame"]);
    }

    if ($roll) {
        if ($game->getWinner() == "") {
            $game->roll();
            $_SESSION["dicegame"] = serialize($game);
        }
    }

    if ($stop) {
        $game->next();
        $_SESSION["dicegame"] = serialize($game);
    }

    return $app->response->redirect("dice/play");
});
