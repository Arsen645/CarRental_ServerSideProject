<?php

include '../header.html';

if (isset($_POST['submitdetails'])) {
try {
$pdo = new PDO('mysql:host=localhost;dbname=CarRentalSys; charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT count(*) FROM cars where PlateNo = :cPlateNo';
$result = $pdo->prepare($sql);
$result->bindValue(':cPlateNo', $_POST['cPlateNo']);
$result->execute();
if($result->fetchColumn() > 0)
{
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'UPDATE FROM cars WHERE PlateNo = :cPlateNo';
$result = $pdo->prepare($sql);
$result->bindValue(':cPlateNo', $_POST['PlateNo']);
$result->execute();
echo "You just UPDATED car no: " . $_POST['PlateNo'] ." \n click
here to go back ";
}
catch (PDOException $e) {
if ($e->getCode() == 23000) {
echo "ooops couldnt delete as that record is linked to other tables click here to go back ";
}
}
}
} ?>