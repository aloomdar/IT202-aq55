<?php
require (__DIR__ . "/scores.php");
require (__DIR__ . "/partials/nav.php");
?>

<?php echo "It works!";?>
<button onclick = "location.href = 'game.php';" id="myButton" class="float-left submit-button">Click here to play the game!</button>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Home Page</title>
</head>
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
        </table>
    </div>
</body>
</html>
