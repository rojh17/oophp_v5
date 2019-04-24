<h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> left</p>


<form method="post">
    <input type="text" name="number">
    <input type="submit" name="guess" value="Make a guess">
    <input type="submit" name="init" value="Reset game">
    <input type="submit" name="cheat" value="Cheat">

</form>

<p></p>

<?php
    echo "<p>{$message}</p>";
?>
