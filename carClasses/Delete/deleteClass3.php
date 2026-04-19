<?php
include '../../connection.php';
session_start();
try {

$sql = 'DELETE FROM carclass WHERE ClassID = :cClassID';
$result = $pdo->prepare($sql);
$result->bindValue(':cClassID', $_POST['ClassID']);
$result->execute();
$_SESSION['update_message'] = "You just deleted class: " . $_POST['ClassName'];

}
catch (PDOException $e) {
if ($e->getCode() == 23000) {

$_SESSION['update_message'] = 'ooops couldnt delete as that record is linked to other tables';
}
}
header("location:../Table/classesTable.php");
    exit;
    
    ?>