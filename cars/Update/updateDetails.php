<?php include '../../connection.php'; ?>
<?php
        $sql = 'SELECT ClassName
                FROM carclass;';
        $result = $pdo->prepare($sql);
        $result->execute(); ?>
<div class="formContainer">
    <h2>Update car</h2>
<form action="updated2.php" method="post">
<input type="hidden" name="ud_plate" value="<?php echo $plateno; ?>">
<p>Plate Number: <?php echo $plateno; ?></p><br>
Brand: <input type="text" name="ud_brand" value="<?php if (isset($brand)) echo $brand; ?>"><br>
Model: <input type="text" name="ud_model" value="<?php if (isset($model))echo $model; ?>"><br>
Status: <input type="text" name="ud_status" value="<?php if (isset($status)) echo $status; ?>"><br>
carClass: <select name="ud_carClass" style="width: 100px;">

        <?php
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        $flag = "";
        while ($row = $result->fetch()) {
                $flag = "";
                if ($row["ClassName"] == $carClass) {
                        $flag = 'selected';
                }
echo 'flag';
        ?><option value="<?php echo $row['ClassName']; ?>" <?php echo $flag; ?>><?php echo $row['ClassName']; ?></option>
        <?php

        }
        ?>
        </select><br>





<input type="Submit" value="Update" class="submitBtn">
</form>
</div>
</body>

</html>