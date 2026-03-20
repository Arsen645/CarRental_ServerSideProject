<?php include '../../connection.php'; ?>
<div class="formContainer">
    <h2>Add a new car</h2>
<form action="addCar.php" method="post">
    Plate Num: <input type="text" name="cplate" value=""> <br>
    Brand: <input type="text" name="cbrand"><br>
    Model: <input type="text" name="cmodel" value=""><br>
    Year: <input type="text" name="cyear"><br>
    Car Class: <select name="ccarClass" style="width: 100px;">
        <?php
        $sql = 'SELECT ClassName
                FROM carclass;';
        $result = $pdo->prepare($sql);
        $result->execute();
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        ?><option value="<?php echo $row['ClassName']; ?>"><?php echo $row['ClassName']; ?></option>
        <?php

        }
        ?>
        </select>
        <br>

        <input type="submit" name="submitCar" value="SUBMIT" class="submitBtn">
</form>
</div>
</body>

</html>