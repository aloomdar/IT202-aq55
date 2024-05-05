<?php
require(__DIR__ . "/partials/nav.php");
?>
<h2>Game page</h2>

<table>
    <tr>
        <th>Player</th>
        <th> </th>
        <th>Score</th>
    </tr>

    <?php
    $db = getDB();
    $stmt = $db->prepare("SELECT username, score from leaderboard");
    $username = se($_POST, "username", "", false);

    try {
        $r = $stmt->execute();
        if ($r) {
            $scores = $stmt->fetchALL(PDO::FETCH_ASSOC);

            foreach ($scores as $score) {
                echo '<tr>';
                echo '<td>' . $score['username'] . '</td>';
                echo '<td>' . " " . '</td>';
                echo '<td>' . $score['score'] . '</td>';
                echo '</tr>';
            }
        }
    } catch (Exception $e) {
        echo var_export($e);
    }
    ?>
</table>

<!-- // if (is_logged_in()) {
//     echo "Username: " . $_SESSION["user"]["username"] . "<br>";
//     $username = $_SESSION["user"]["username"];
//     echo "Email: " . $_SESSION["user"]["email"] . "<br";
// } -->

<!DOCTYPE html>
<html>


<body>
    <p id="p1">Score:<span id="score"></span></p>
    <p id="p2">High Score:<span id="high"></span></p>
    <canvas width="400" height="400" id="game"></canvas>
    <script>
        var canvas = document.getElementById('game');
        var context = canvas.getContext('2d');
        var grid = 16;
        var count = 0;
        var score = 0;
        var max = 0;

        var snake = {
            x: 160,
            y: 160,

            dx: grid,
            dy: 0,

            cells: [],

            maxCells: 4
        };

        var food = {
            x: 320,
            y: 320
        };

        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        }

        function loop() {
            requestAnimationFrame(loop);
            if (++count < 4) {
                return;
            }
            count = 0;
            context.clearRect(0, 0, canvas.width, canvas.height);

            snake.x += snake.dx;
            snake.y += snake.dy;

            if (snake.x < 0) {
                snake.x = canvas.width - grid;
            } else if (snake.x >= canvas.width) {
                snake.x = 0;
            }

            if (snake.y < 0) {
                snake.y = canvas.height - grid;
            } else if (snake.y >= canvas.height) {
                snake.y = 0;
            }

            snake.cells.unshift({
                x: snake.x,
                y: snake.y
            });

            if (snake.cells.length > snake.maxCells) {
                snake.cells.pop();
            }

            context.fillStyle = 'blue';
            context.fillRect(food.x, food.y, grid - 1, grid - 1);

            context.fillStyle = '#E43F5A';
            snake.cells.forEach(function(cell, index) {

                context.fillRect(cell.x, cell.y, grid - 1, grid - 1);

                if (cell.x === food.x && cell.y === food.y) {
                    snake.maxCells++;
                    score += 1;
                    document.getElementById('score').innerHTML = '&nbsp;' + score;

                    food.x = getRandomInt(0, 25) * grid;
                    food.y = getRandomInt(0, 25) * grid;
                }

                for (var i = index + 1; i < snake.cells.length; i++) {

                    if (cell.x === snake.cells[i].x && cell.y === snake.cells[i].y) {
                        //aq55 5/5/24
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "insert_score.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                console.log(xhr.responseText);
                            }
                        };
                        xhr.send("score=" + score);
                        if (score > max) {
                            max = score;
                        }
                        snake.x = 160;
                        snake.y = 160;
                        snake.cells = [];
                        snake.maxCells = 4;
                        snake.dx = grid;
                        snake.dy = 0;
                        score = 0;
                        food.x = getRandomInt(0, 25) * grid;
                        food.y = getRandomInt(0, 25) * grid;
                        document.getElementById('high').innerHTML = '&nbsp;' + max;
                    }
                }
            });
        }

        document.addEventListener('keydown', function(e) {
            // left arrow key
            if (e.which === 37 && snake.dx === 0) {
                snake.dx = -grid;
                snake.dy = 0;
            }
            // up arrow key
            else if (e.which === 38 && snake.dy === 0) {
                snake.dy = -grid;
                snake.dx = 0;
            }
            // right arrow key
            else if (e.which === 39 && snake.dx === 0) {
                snake.dx = grid;
                snake.dy = 0;
            }
            // down arrow key
            else if (e.which === 40 && snake.dy === 0) {
                snake.dy = grid;
                snake.dx = 0;
            }
        });
        // start the game
        requestAnimationFrame(loop);
    </script>
</body>

</html>