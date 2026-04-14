<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE carclass 
            SET ClassName = :cClassName, Description = :cDescription, MonthlyRate = :cMonthlyRate 
            WHERE ClassID = :cClassID';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cClassID', $_POST['cClassID']);
    $stmt->bindValue(':cClassName', $_POST['cClassName']);
    $stmt->bindValue(':cDescription', $_POST['cDescription']);
    $stmt->bindValue(':cMonthlyRate', $_POST['cMonthlyRate']);
    $stmt->execute();
//For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
    if ($stmt->rowCount() > 0) {
        echo "You just updated car class no: " . $_POST['cClassID'] .
             " � click <a href='/arsen/CarRental_ServerSideProject/qindex.php'>here</a> to go back";
    } else {
        echo "Nothing updated (either no such car class, or values were unchanged).".
             " � click <a href='/arsen/CarRental_ServerSideProject/qindex.php'>here</a> to go back";
    }

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}
?>