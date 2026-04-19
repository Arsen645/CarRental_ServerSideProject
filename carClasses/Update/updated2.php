<?php
session_start(); 

try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE carclass 
            SET ClassName = :cClassName, Description = :cDescription, Rate = :cRate 
            WHERE ClassID = :cClassID';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cClassID', $_POST['cClassID']);
    $stmt->bindValue(':cClassName', $_POST['cClassName']);
    $stmt->bindValue(':cDescription', $_POST['cDescription']);
    $stmt->bindValue(':cRate', $_POST['cRate']);
    $stmt->execute();
//For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
    if ($stmt->rowCount() > 0) {
        $_SESSION['update_message'] = 'You just updated car class no: ' . $_POST['cClassID'];
             
    } else {
        $_SESSION['update_message'] = "Nothing updated (either no such car class or values unchanged).";

    }
    header("location:../Table/classesTable.php");
    exit;

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}
?>