<?php
include '../../connection.php';
try {

    $sql = 'UPDATE cars 
            SET Status = "D" 
            WHERE plateno = :cPlateNo
            AND NOT EXISTS (
    SELECT *
    FROM rentals
    WHERE rentals.CarPlateNo = cars.PlateNo
    AND rentals.FinishDate > NOW()
    );';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cPlateNo', $_POST['plateno']);
    $stmt->execute();
    //For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
    if ($stmt->rowCount() > 0) {
        $_SESSION['carDeleteMsg'] = 'You just deleted car.';

            header("location:../../qindex.php");
    exit;
    } else {
        $_SESSION['carDeleteMsg'] = 'ooops couldnt delete as that car has future reservations';
            header("location:../../qindex.php");
    exit;
    }

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}
?>