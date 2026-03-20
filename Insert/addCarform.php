<?php include '../connection.php'; ?>

<form action="addCar.php" method="post">
    Plate Num: <input type="text" name="cplateFirst" value=""> -
    <input type="text" name="cplateRegion" value=""> -
    <input type="text" name="cplateLast" value=""> <br>
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

        <input type="submit" name="submitCar" value="SUBMIT">
</form>
</body>

</html>