<?php include '../../connection.php';
?>

<div class="formContainer">

<form action="AddCustomer.php" method="post">    
    
     Customer ID: <!-- <input type="text" name="cclassid" value=""><br> -->
        <?php


        $sql = 'SELECT MAX(CustomerID) as maxId
                FROM customers';
        $result = $pdo->prepare($sql);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['maxId'] !== null) {
            $row['maxId'] += 1;
            echo $row['maxId'];
        } else {
            echo "No data found!";
        }

        ?><br><br>
        
        CorporateName: <input type="text" name="ccustName" ><br>
        Email: <input type="text" name="cemail"   value = ""><br>
        Phone: <input type="text" name="cphone" ><br>
        
        <input type="submit" name="addCustomer" value="SUBMIT" class="submitBtn">
     </form>

     </div>
 </body>
</html>
