<?php
function daily(){
    $db = getDB();
    $stmt = $db->prepare("SELECT score, user_id, modified FROM Scores WHERE DATE(modified) = CURDATE() LIMIT 10");
    try{
        $r = $stmt->execute();
        if($r){
            $scores = $stmt->fetchALL(PDO::FETCH_ASSOC); 
      
            foreach($scores as $score){
                echo '<tr>'; 
                echo '<td>' . $score['user_id'] . '</td>'; 
                echo '<td>' . $score['score'] . '</td>'; 
                echo '<td>' . $score['modified'] . '</td>'; 
                echo '</tr>';
            }
        }
    }
    catch(Exception $e){
        echo var_export($e);
    }
}

function weekly(){
    $db = getDB();
    $stmt = $db->prepare("SELECT score, user_id, modified FROM Scores WHERE modified >= CURRENT_DATE - INTERVAL 7 DAY LIMIT 10");
    try{
        $r = $stmt->execute();
        if($r){
            $scores = $stmt->fetchALL(PDO::FETCH_ASSOC); 
      
            foreach($scores as $score){
                echo '<tr>'; 
                echo '<td>' . $score['user_id'] . '</td>'; 
                echo '<td>' . $score['score'] . '</td>'; 
                echo '<td>' . $score['modified'] . '</td>'; 
                echo '</tr>';
            }
        }
    }
    catch(Exception $e){
        echo var_export($e);
    }
}

/*

*/
function monthly(){

    $db = getDB();
    $stmt = $db->prepare("SELECT score, user_id, modified FROM Scores WHERE MONTH(modified) = MONTH(CURDATE()) LIMIT 10");
    try{
        $r = $stmt->execute();
        if($r){
            $scores = $stmt->fetchALL(PDO::FETCH_ASSOC); 
      
            foreach($scores as $score){
                echo '<tr>'; 
                echo '<td>' . $score['user_id'] . '</td>'; 
                echo '<td>' . $score['score'] . '</td>'; 
                echo '<td>' . $score['modified'] . '</td>'; 
                echo '</tr>';
            }
        }
    }
    catch(Exception $e){
        echo var_export($e);
    }
}