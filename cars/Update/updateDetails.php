<?php include '../../connection.php'; 
$selectedStatus = $_POST['ud_status'] ?? '';
$selectedClass  = $_POST['ud_carClass'] ?? '';?>

<div class="formContainer">
    <h2>Update car</h2>
<form action="" method="POST">
<input type="hidden" name="ud_plate" value="<?php echo $plateno; ?>">
<p>Plate Number: <?php echo $plateno; ?></p><br>
<!-- Brand: <input type="text" name="ud_brand" value="<?php //if (isset($brand)) echo $brand; ?>"><br> -->

Brand: <select name="ud_brand" style="width: 100%;" onchange="this.form.submit()" >  <!--  ////link (show only models of selected brand)onchange="this.form.submit()" -->
        <?php
        $flag = 0;
        $selectedBrandId = $_POST['ud_brand'] ?? '';  ////link (show only models of selected brand)
        $sql = 'SELECT *
                FROM brand;';
        $result = $pdo->prepare($sql);
        $result->execute();
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
$flag = 1;
        ?><option value="<?php echo $row['brandid']; ?>" 
        <?php echo ($row['brandid'] == $selectedBrandId) ? 'selected' : '' ?>><?php echo $row['brandname']; ?></option>
        <?php

        }
        ?><br>
        </select>

<!-- Model: <input type="text" name="ud_model" value="<?php //if (isset($model))echo $model; ?>"> -->
Model: <select name="ud_model" style="width: 100%;" required>
        <?php
        if ($flag == 1) {
        $sql = 'SELECT modelname 
                FROM model
                WHERE brandid = :cbrandid';
        $result = $pdo->prepare($sql);
        $result->bindValue(':cbrandid', $selectedBrandId);
        $result->execute();
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        ?><option value="<?php echo $row['modelname']; ?>"><?php echo $row['modelname']; ?></option>
        <?php

        }
        }
        ?>
        </select><br>






carClass: <select name="ud_carClass" style="width: 100px;">

<?php
        $sql = 'SELECT ClassName
                FROM carclass;';
        $result = $pdo->prepare($sql);
        $result->execute();

        
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        $flag = "";
        while ($row = $result->fetch()) {
                $flag = "";
                if ($row["ClassName"] == $carClass) {
                        $flag = 'selected';
                }
        ?><option value="<?php echo $row['ClassName']; ?>" <?php echo $flag; ?>><?php echo $row['ClassName']; ?></option>
        <?php

        }
        ?>
        </select><br>





<input type="Submit" name="Update" value="Update" class="submitBtn">
</form>
</div>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['Update'])){

try {

    $brandid = $_POST['ud_brand'];  
$sqlBrand = 'SELECT brandname FROM brand WHERE brandid = :cbrand';
$stmtBrand = $pdo->prepare($sqlBrand);
$stmtBrand->bindValue(':cbrand', $brandid);
$stmtBrand->execute();

if ($stmtBrand->rowCount() > 0) {
    $brandRow = $stmtBrand->fetch(PDO::FETCH_ASSOC);
    $brandName = $brandRow['brandname'];  
}

$sql = 'UPDATE cars 
        SET Brand = :cbrand, Model = :cmodel, Status = :cstatus, carClass = :ccarClass 
        WHERE plateno = :cplate';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':cplate', $_POST['ud_plate']);
$stmt->bindValue(':cbrand', $brandName);  
$stmt->bindValue(':cmodel', $_POST['ud_model']);
$stmt->bindValue(':cstatus', 'A');
$stmt->bindValue(':ccarClass', $_POST['ud_carClass']);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo '<script> alert("Updated successfully!"); </script>';
} else {
    echo '<script> alert("Nothing updated (either no such car, or values were unchanged)."); </script>';
}

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}
}
}
?> 
</body>

</html>