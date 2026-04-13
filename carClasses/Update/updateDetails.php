<?php include '../../connection.php'; ?>

<div class="formContainer">
    <h2>Update car</h2>
<form action="updated2.php" method="post">
<input type="hidden" name="ClassID" value="<?php echo $ClassID; ?>">
<p>ClassID: <?php echo $ClassID; ?></p><br>
Brand: <input type="text" name="ud_brand" value="<?php if (isset($brand)) echo $brand; ?>"><br>
Model: <input type="text" name="ud_model" value="<?php if (isset($model))echo $model; ?>"><br>
Status: 
        <select name="ud_status" style="width: 100px;">

<?php
        $sql = 'SELECT StatusName
                FROM carstatus;';
        $result = $pdo->prepare($sql);
        $result->execute();

        
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        $flag = "";
        while ($row = $result->fetch()) {
                $flag = "";
                if ($row["StatusName"] == $StatusName) {
                        $flag = 'selected';
                }
echo 'flag';
        ?><option value="<?php echo $row['StatusName']; ?>" <?php echo $flag; ?>><?php echo $row['StatusName']; ?></option>
        <?php

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