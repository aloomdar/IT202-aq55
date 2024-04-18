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

try{
    $r = $stmt->execute();
    if ($r) { 
        $scores = $stmt->fetchALL(PDO::FETCH_ASSOC); 
      
        foreach($scores as $score){
            echo '<tr>'; 
            echo '<td>' . $score['username'] . '</td>'; 
            echo '<td>' . " " . '</td>'; 
            echo '<td>' . $score['score'] . '</td>'; 
            echo '</tr>';

        }
    }
}catch(Exception $e){
    echo var_export($e);
}
?>
</table>

