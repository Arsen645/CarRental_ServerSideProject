<?php
include 'header.html';
if (isset($_POST['addCustomer'])) {                   
try {  

    $ccustName = htmlspecialchars(trim($_POST['ccustName']));
    $cemail = htmlspecialchars(trim($_POST['cemail']));
    $cphone = htmlspecialchars(trim($_POST['cphone']));
    if ($ccustName == ''  or $cemail == '' or $cphone == '')
    {
        echo("You did not complete the insert form correctly <br> ");
    } elseif(!filter_var($cemail, FILTER_VALIDATE_EMAIL)){
        echo("invalid email");
    }
else{
    $pdo = new PDO('mysql:host=localhost;dbname=CarRentalSys; charset=utf8', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $sql = "INSERT INTO customers (CorporateName,Email,Phone) 
    VALUES(:ccustName, :cemail, :cphone)";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindValue(':ccustName', $ccustName);
    $stmt->bindValue(':cemail', $cemail);
    $stmt->bindValue(':cphone', $cphone);
    
    $stmt->execute();
echo  "Added try doing another";
    }
} 
catch (PDOException $e) { 
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    echo $output;
} 
} 
 include 'addCustomerform.html' 
 ?>
