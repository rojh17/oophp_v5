<h1>Dice-game 100</h1>

<h2>It's player <?= $player ?>'s turn</h2>


<form method="post">
    <label for="number">Number of dices</label>
    <input type="number" name="number" value=<?= $dices ?>>
    <input type="submit" name="roll" value="Roll">
    <input type="submit" name="stop" value="Stop">
    <input type="submit" name="init" value="Reset game">
</form>

<p></p>

<p>
<?php foreach ($graphics as $value) : ?>
    <i class="dice-sprite <?= $value ?>"></i>
<?php endforeach; ?>
</p>

<h2>Score</h2>
<?php foreach ($score as $key => $value) { ?>
    <p> <?= $key ?>: <?= $value ?></p>
<?php } ?>


<p><?= $message ?></p>
