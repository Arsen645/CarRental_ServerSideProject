<?php

include '../../header.html';

if (isset($_POST['submitdetails'])) {
try {
$pdo = new PDO('mysql:host=localhost;dbname=CarRentalSys; charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT count(*) FROM customers where CustomerID = :cCustomerID';
$result = $pdo->prepare($sql);
$result->bindValue(':cCustomerID', $_POST['CustomerID']);
$result->execute();
if($result->fetchColumn() > 0)
{
$sql = 'SELECT * FROM customers where CustomerID = :cCustomerID';
$result = $pdo->prepare($sql);
$result->bindValue(':cCustomerID', $_POST['CustomerID']);
$result->execute();
while ($row = $result->fetch()) {
echo $row['CustomerID'] . ' ' . $row['CorporateName'] . ' Are you sure you want to delete ??' .
'<form action="deleteCustomer3.php" method="post">
<input type="hidden" name="CustomerID" value="'.$row['CustomerID'].'">
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