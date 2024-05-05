<?php
require (__DIR__ . "/scores.php");
require (__DIR__ . "/partials/nav.php");
?>

<?php echo "It works!";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Home Page</title>
</head>
<center>
<h1>Welcome! This is a page showing scores for the snake game I have made. The objective of the game is to eat as much as you can as the snake and not die.</h1>
<h1>Use the arrow keys to move the snake and eat the blue food.</h1>
<h2><a href="game.php">Play Game</a></h2>
</center>
<body>
    <div class="main">
        <table>
            <h2>Daily Scores</h2>
            <tr>
                <td>Player</td>
                <td>Score</td>
                <td>Date</td>
            </tr>
            <tr>
                <?php
                daily();
                ?>
            </tr>
        </table>
        <table>
            <h2>Weekly Scores</h2>
            <tr>
                <td>Player</td>
                <td>Score</td>
                <td>Date</td>
            </tr>
            <tr>
                <?php
                weekly();
                ?>
            </tr>
        </table>
        <table>
            <h2>Monthly Scores</h2>
            <tr>
                <td>Player</td>
                <td>Score</td>
                <td>Date</td>
            </tr>
            <tr>
                <?php
                monthly();
                ?>
            </tr>
        </table><table>
            <h2>Lifetime Scores</h2>
            <tr>
                <td>Player</td>
                <td>Score</td>
                <td>Date</td>
            </tr>
            <tr>
                <?php
                lifetime();
                ?>
            </tr>
        </table>
    </div>
</body>
</html>