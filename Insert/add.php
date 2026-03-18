<?php
include 'header.html';
if (isset($_POST['submitdetails'])) {                   
try {  
    $classname = $_POST['classname'];
    $cdescription = $_POST['cdescription'];
    $cmonthlyrate = round((float)$_POST['cmonthlyrate'], 2);
    if ($classname == '' or $cdescription == ''  or $cmonthlyrate == '')
    {
        echo("You did not complete the insert form correctly <br> ");
                  }
else{
    $pdo = new PDO('mysql:host=localhost;dbname=CarRentalSys; charset=utf8', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $sql = "INSERT INTO CarClass (classname,description,monthlyrate) 
    VALUES(:classname, :cdescription, :cmonthlyrate)";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindValue(':classname', $classname);
    $stmt->bindValue(':cdescription', $cdescription);
    $stmt->bindValue(':cmonthlyrate', $cmonthlyrate);
    
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

 include 'addCarClassform.html' 
 ?>
