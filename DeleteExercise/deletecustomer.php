<?php
try {
$pdo = new PDO('mysql:host=localhost;dbname=CarRentalSys; charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'DELETE FROM cars WHERE PlateNo = :cPlateNo';
$result = $pdo->prepare($sql);
$result->bindValue(':cPlateNo', $_POST['PlateNo']);
$result->execute();
echo "You just deleted car no: " . $_POST['PlateNo'] ." \n click<a href='deleteform.html'>
here</a> to go back ";
}
catch (PDOException $e) {
if ($e->getCode() == 23000) {
echo "ooops couldnt delete as that record is linked to other tables click<a
href='deleteform.html'> here</a> to go back ";
}
} ?>