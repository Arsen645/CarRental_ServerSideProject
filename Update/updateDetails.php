<?php include '../connection.php'; ?>
<?php
        $sql = 'SELECT ClassName
                FROM carclass;';
        $result = $pdo->prepare($sql);
        $result->execute(); ?>

<form action="updated.php" method="post">
<input type="hidden" name="ud_plate" value="<?php echo $plateno; ?>">
<p>Plate Number: <?php echo $plateno; ?></p>
Brand: <input type="text" name="ud_brand" value="<?php if (isset($brand)) echo $brand; ?>"><br>
Model: <input type="text" name="ud_model" value="<?php if (isset($model))echo $model; ?>"><br>
Status: <input type="text" name="ud_status" value="<?php if (isset($status)) echo $status; ?>"><br>
carClass: <select name="ccarClass" style="width: 100px;">

        <?php
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        $flag = "2";
        while ($row = $result->fetch()) {
                
                if ($row["ClassName"] == $carClass) {
                        $flag = 'selected';
                }
echo 'flag';
        ?><option value="<?php echo $row['ClassName']; ?>" <?php echo $flag; ?>><?php echo $row['ClassName']; ?></option>
        <?php

        }
        ?>
        </select><br>



<!-- <input type="text" name="ud_carClass" value="<?php if (isset($carClass))echo $carClass; ?>"> -->


<input type="Submit" value="Update">
</form>
</body>

</html>