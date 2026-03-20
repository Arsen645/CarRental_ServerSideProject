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
$sql = 'SELECT * FROM cars where PlateNo = :cPlateNo';
$result = $pdo->prepare($sql);
$result->bindValue(':cPlateNo', $_POST['cPlateNo']);
$result->execute();
while ($row = $result->fetch()) {
echo $row['Brand'] . ' ' . $row['Model'] . ' Are you sure you want to delete ??' .
'<form action="deletecar.php" method="post">
<input type="hidden" name="PlateNo" value="'.$row['PlateNo'].'">
<input type="submit" value="yes delete" name="delete">
</form>';
}
}
else {
print "No rows matched the query.";
}}
catch (PDOException $e) {
$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile()
. ':' . $e->getLine();
}
}
include 'deleteform.html'
//24-KY-12345, Toyota, Corolla, 2024, A, reg, 100.00$
?>