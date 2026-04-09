<?php
try {
$pdo = new PDO('mysql:host=localhost;dbname=CarRentalSys; charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'DELETE FROM Customers WHERE CustomerID = :cCustomerID';
$result = $pdo->prepare($sql);
$result->bindValue(':cCustomerID', $_POST['CustomerID']);
$result->execute();
echo "You just deleted customer: " . $_POST['CorporateName'] ." \n click<a href='../../qindex.php'>
here</a> to go back ";
}
catch (PDOException $e) {
if ($e->getCode() == 23000) {
echo "ooops couldnt delete as that record is linked to other tables click<a
href='../../qindex.php'> here</a> to go back ";
}
} ?>