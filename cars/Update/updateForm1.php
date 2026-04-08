<?php
include '../../connection.php';

include '../../header.html';

try {

    if (!isset($_POST['ud_plate']) ) {
        die("No ID provided.");
    }

    $sql = "SELECT * FROM cars WHERE plateno = :cplateno";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cplateno', $_POST['ud_plate']);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $plateno = $row['PlateNo'];
        $brand = $row['Brand'];
        $model = $row['Model'];
        $status = $row['Status'];
        $carClass = $row['carClass'];
    } 
    else {
        echo "No rows matched the query. Try again <a href='selectupdate.php'>here</a>";
    }

} catch (PDOException $e) {
    echo 'Unable to connect to the database server: ' . $e->getMessage();
}

include 'updateDetails.php';
?>
