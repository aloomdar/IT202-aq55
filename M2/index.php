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
<body>
    <div class="main">
        <table>
            <h1>Daily Scores</h1>
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
            <h1>Weekly Scores</h1>
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
    </div>
</body>
</html>