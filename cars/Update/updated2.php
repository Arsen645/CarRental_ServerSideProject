<?php
include '../../connection.php';
try {

    $sql = 'UPDATE cars 
            SET Brand = :cbrand, Model = :cmodel, Status = :cstatus, carClass = :ccarClass 
            WHERE plateno = :cplate';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cplate', $_POST['ud_plate']);
    $stmt->bindValue(':cbrand', $_POST['ud_brand']);
    $stmt->bindValue(':cmodel', $_POST['ud_model']);
    $stmt->bindValue(':cstatus', $_POST['ud_status']);
    $stmt->bindValue(':ccarClass', $_POST['ud_carClass']);
    $stmt->execute();
//For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
    if ($stmt->rowCount() > 0) {
        echo "You just updated car no: " . $_POST['ud_plate'] .
             " � click <a href='/arsen/CarRental_ServerSideProject/qindex.php'>here</a> to go back";
    } else {
        echo "Nothing updated (either no such car, or values were unchanged).".
             " � click <a href='/arsen/CarRental_ServerSideProject/qindex.php'>here</a> to go back";
    }

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}
?>