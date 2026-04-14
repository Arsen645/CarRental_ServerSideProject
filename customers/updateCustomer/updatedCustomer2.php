<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        
        echo "You just updated customer: " . $_POST['CustomerID'] .
             " � click <a href='/arsen/CarRental_ServerSideProject/qindex.php'>here</a> to go back";
    } else {
        echo "Nothing updated (either no such customer, or values were unchanged).".
             " � click <a href='/arsen/CarRental_ServerSideProject/qindex.php'>here</a> to go back";
    }
    ?> </p> <?php

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}
?>