<?php
try {
$pdo = new PDO('mysql:host=localhost;dbname=CarRentalSys; charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'DELETE FROM carclass WHERE ClassID = :cClassID';
$result = $pdo->prepare($sql);
$result->bindValue(':cClassID', $_POST['ClassID']);
$result->execute();
echo "You just deleted class no: " . $_POST['ClassID'] ." \n click<a href='../../qindex.php'>
here</a> to go back ";
}
catch (PDOException $e) {
if ($e->getCode() == 23000) {
echo "ooops couldnt delete as that record is linked to other tables click<a
href='../../qindex.php'> here</a> to go back ";
}
} ?>