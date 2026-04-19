<?php include '../../connection.php'; 
 ?>
<div class="formContainer">
    <h2>Add a new car</h2>
<form action="addCar.php" method="post">
    
    <!-- Brand: <input type="text" name="cbrand"><br> -->
   Brand: <select name="cbrand" style="width: 100%;" onchange="this.form.submit()" >  <!--  ////link (show only models of selected brand)onchange="this.form.submit()" -->
        <?php
        $flag = 0;
        $selectedBrandId = isset($_POST['cbrand']) ? $_POST['cbrand'] : '';  ////link (show only models of selected brand)
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
        ?>
        </select>
        <br>
    <!-- Model: <input type="text" name="cmodel" value=""><br> -->
     Model: <select name="cmodel" style="width: 100%;">
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
        </select>
        <br>
    Plate Num: <input type="text" name="cplate" value=""> <br>
    Year: <input type="text" name="cyear"><br>
    Car Class: <select name="ccarClass" style="width: 100px;">
        <?php
        $sql = 'SELECT ClassName, description
                FROM carclass;';
        $result = $pdo->prepare($sql);
        $result->execute();
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        ?><option value="<?php echo $row['ClassName']; ?>"><?php echo $row['ClassName'] . ' - ' .$row['description']; ?></option>
        <?php

        }
        ?>
        </select>
        <br>
        
        

        <input type="submit" name="submitCar" value="SUBMIT" class="submitBtn">
</form>
</div>


