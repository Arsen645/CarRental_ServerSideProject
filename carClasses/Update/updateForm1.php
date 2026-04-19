<?php
include '../../connection.php';

include '../../header.html';

try {

    if (!isset($_POST['ClassID']) ) {
        die("No ID provided.");
    }

    $sql = "SELECT * FROM carclass WHERE ClassID = :cClassID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cClassID', $_POST['ClassID']);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $ClassID = $row['ClassID'];
        $ClassName = $row['ClassName'];
        $Description = $row['Description'];
        $Rate = $row['Rate'];
    } 
    else {
        echo "No rows matched the query. Try again <a href='selectupdate.php'>here</a>";
    }

} catch (PDOException $e) {
    echo 'Unable to connect to the database server: ' . $e->getMessage();
}

include 'updateDetails.php';
?>
