<?php
require(__DIR__ . "/partials/nav.php");
?>

<h2>Test page for displaying car table</h2>

<table>
    <tr>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
    </tr>


<?php
$db = getDB();
$stmt = $db->prepare("SELECT make, model, year from Cars");

try{
    $r = $stmt->execute();
    if ($r) { //if r is executed, we proceed, if we get an exception then we echo the error
        $cars = $stmt->fetchALL(PDO::FETCH_ASSOC); //fetch gets one line, fetchALL gets all lines because we loop thru an array
        // echo var_export($cars); //echos the line from the table that we get when executing the statement
        
        //the foreach loop loops through the data stored in $cars
        foreach($cars as $car){
            echo '<tr>'; //echos php to the computer. tr is table row
            echo '<td>' . $car['make'] . '</td>'; //can select specific information from each line. td is table data
            echo '<td>' . $car['model'] . '</td>'; 
            echo '<td>' . $car['year'] . '</td>'; 
            echo '</tr>';

        }
    }
}catch(Exception $e){
    echo var_export($e);
}
?>
</table>