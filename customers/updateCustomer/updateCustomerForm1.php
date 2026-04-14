<?php
include '../../connection.php';

include '../../header.html';

try {

    if (!isset($_POST['CustomerID']) ) {
        die("No ID provided.");
    }

    $sql = "SELECT * FROM customers WHERE customerid = :ccustid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':ccustid', $_POST['CustomerID']);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $CustomerID = $row['CustomerID'];
        $CorporateName = $row['CorporateName'];
        $Email = $row['Email'];
        $Phone = $row['Phone'];
    } 
    else {
        echo "No rows matched the query. Try again <a href='selectupdate.php'>here</a>";
    }

} catch (PDOException $e) {
    echo 'Unable to connect to the database server: ' . $e->getMessage();
}

include 'updateCustomerDetails.php';
?>
