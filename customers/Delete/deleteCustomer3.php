<?php
include '../../connection.php';

try {
$sql = 'DELETE FROM Customers WHERE CustomerID = :cCustomerID';
$result = $pdo->prepare($sql);
$result->bindValue(':cCustomerID', $_POST['CustomerID']);
$result->execute();
        $_SESSION['customers_message'] = 'You just deleted customer: ' . $_POST['CorporateName'];

}
catch (PDOException $e) {
if ($e->getCode() == 23000) {
        $_SESSION['customers_message'] = 'ooops couldnt delete as that record is linked to other tables';

}
} 

header("location:../Table/custTable.php");
    exit;
    
    ?>