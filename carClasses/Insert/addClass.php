<?php
include '../../header.html';
include '../../connection.php';

if (isset($_POST['submitdetails1'])) {                   
try {  
    
    $classname = $_POST['classname'];
    $cdescription = $_POST['cdescription'];
    $crate = round((float)$_POST['crate'], 2);
    if ($classname == '' or $cdescription == ''  or $crate == '')
    {
        echo("You did not complete the insert form correctly <br> ");
                  }
else{
    $sql = "INSERT INTO CarClass (classname,description,rate) 
    VALUES(UPPER(:classname), :cdescription, :crate)";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindValue(':classname', $classname);
    $stmt->bindValue(':cdescription', $cdescription);
    $stmt->bindValue(':crate', $crate);
    
    $stmt->execute();
echo  '<script> alert("Class successfully added");</script>';
    }
} 
catch (PDOException $e) { 
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    echo $output;
} 
} 

 include 'addCarClassform.php' 
 ?>
