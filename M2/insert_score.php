<?php
//aq55 5/5/24
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["score"])) {
    $score = $_POST["score"];

    $db = getDB(); 
    $stmt = $db->prepare("INSERT INTO Scores (user_id, score) VALUES (:username, :score)");
    try {
        $stmt->execute([":username" => $username, ":score" => $score]);
        echo "Score inserted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request or missing score data!";
}
?>
