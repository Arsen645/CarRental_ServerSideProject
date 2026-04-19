<?php
include '../../connection.php';
try {

    $sql = 'UPDATE customers 
            SET CorporateName = :cCorporateName, Email = :cEmail, Phone = :cPhone
            WHERE CustomerID = :cCustomerID';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cCustomerID', $_POST['CustomerID']);
    $stmt->bindValue(':cEmail', $_POST['Email']);
    $stmt->bindValue(':cPhone', $_POST['Phone']);
    $stmt->bindValue(':cCorporateName', $_POST['CorporateName']);
    $stmt->execute();
//For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
?> <p class="confirmation"> <?php
    if ($stmt->rowCount() > 0) {
        $_SESSION['customers_message'] = 'You just updated customer: ' . $_POST['CorporateName'];
    } else {
        $_SESSION['customers_message'] = 'Nothing updated (either no such customer, or values were unchanged).';
    }
    ?> </p> <?php

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}
header("location:../Table/custTable.php");
    exit;
?>