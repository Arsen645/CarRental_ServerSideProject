


<?php
include '../../connection.php';
try {

    $sql = 'UPDATE cars 
            SET Status = "D" 
            WHERE plateno = :cPlateNo';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cPlateNo', $_POST['plateno']);
    $stmt->execute();
//For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
    if ($stmt->rowCount() > 0) {
        echo "You just deleted car no: " . $_POST['plateno'] .
             " � click <a href='/arsen/CarRental_ServerSideProject/qindex.php'>here</a> to go back";
    } else {
        echo "Nothing updated (either no such car, or values were unchanged).".
             " � click <a href='/arsen/CarRental_ServerSideProject/qindex.php'>here</a> to go back";
    }

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}
?>