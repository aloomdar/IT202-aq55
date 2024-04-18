<?php
require(__DIR__ . "/partials/nav.php");
?>

<h2>Test page for displaying car table</h2>

<script>
    console.log("test js");
    function delete_car(id) {
        console.log(id);
    }
</script>

<form>
    <div>
        <label for="make">Make</label>
        <input type="text" name="make" required />
    </div>
    <div>
        <label for="model">Model</label>
        <input type="text" name="model" required />
    </div>
    <div>
        <label for="year">Year</label>
        <input type="text" name="year" required />
    </div>
    <input type="submit" value="Add Car" />
</form>

<table>
    <tr>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
    </tr>


    <?php

    //isset checks to see if the value is null. if it is, then there will be an error on the screen. isset prevents error
    if (isset($_GET['make']) && isset($_GET['model']) && isset($_GET['year'])) {
        $make = $_GET['make'];
        $model = $_GET['model'];
        $year = $_GET['year'];

        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Cars (make, model, year) VALUES(:make, :model, :year)");
        try {
            $stmt->execute([":make" => $make, ":model" => $model, "year" => $year]);
            echo "Successfully registered!";
        } catch (Exception $e) {
            echo "There was a problem registering";
            "<pre>" . var_export($e, true) . "</pre>";
        }
    }



    $db = getDB();
    $stmt = $db->prepare("SELECT make, model, year, id from Cars");

    try {
        $r = $stmt->execute();
        if ($r) { //if r is executed, we proceed, if we get an exception then we echo the error
            $cars = $stmt->fetchALL(PDO::FETCH_ASSOC); //fetch gets one line, fetchALL gets all lines because we loop thru an array
            // echo var_export($cars); //echos the line from the table that we get when executing the statement

            //the foreach loop loops through the data stored in $cars
            foreach ($cars as $car) {
                echo '<tr>'; //echos php to the computer. tr is table row
                echo '<td>' . $car['make'] . '</td>'; //can select specific information from each line. td is table data
                echo '<td>' . $car['model'] . '</td>';
                echo '<td>' . $car['year'] . '</td>';
                echo '<td><input type="button" onclick="delete_car('. $car['id'] .')" value="delete"</td>';
                echo '</tr>';
            }
        }
    } catch (Exception $e) {
        echo var_export($e);
    }
    ?>
</table>