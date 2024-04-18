<?php
require(__DIR__ . "/partials/nav.php");

echo "<h2>Profile</h2>";

if (is_logged_in()) {
    echo "Username: " . $_SESSION["user"]["username"] . "<br>";
    $username = $_SESSION["user"]["username"];
    echo "Email: " . $_SESSION["user"]["email"] . "<br";
} else {
    echo "You're not logged in";
}
?>

<table>
    <tr>
        <th> <br> Latest Scores <br> </th>
    </tr>

    <?php
    $db = getDB();
    $stmt = $db->prepare("SELECT score from Scores where user_id = :username ORDER BY created DESC");
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $scores = $stmt->fetchALL(PDO::FETCH_ASSOC); 
    foreach($scores as $score){
        echo '<tr>'; 
        echo '<td>' . $score['score'] . ' <br> </td>';  
        echo '</tr>';

    }

    ?>

</table>