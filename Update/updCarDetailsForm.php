<?php include '../connection.php'; ?>


<form action="" method="post">
<input type="hidden" name="ud_plate" value="<?php echo $plateno; ?>">
<p>Plate Number: <?php echo $plateno; ?></p>
Brand: <input type="text" name="ud_brand" value="<?php if (isset($brand)) echo $brand; ?>"><br>
Model: <input type="text" name="ud_model" value="<?php if (isset($model))echo $model; ?>"><br>

<?php
        $sql = 'SELECT status
                FROM statuses;';
        $result = $pdo->prepare($sql);
        $result->execute(); ?>
Status: <select name="ud_status" style="width: 100px;">
        
<?php
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        $flag = "";
        while ($row = $result->fetch()) {
                
                if ($row["status"] == $status) {
                        $flag = 'selected';
                }
                
        ?><option value="<?php echo $row['status']; ?>" <?php echo '$flag'; ?>><?php echo $row['status']; ?></option>
        <?php

        }
        ?>
        </select><br>






<?php
        $sql = 'SELECT ClassName
                FROM carclass;';
        $result = $pdo->prepare($sql);
        $result->execute(); ?>
carClass: <select name="ud_carClass" style="width: 100px;">

        <?php
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        $flag = "";
        while ($row = $result->fetch()) {
                
                if ($row["ClassName"] == $carClass) {
                        $flag = 'selected';
                }

        ?><option value="<?php echo $row['ClassName']; ?>" <?php echo '$flag'; ?>><?php echo $row['ClassName']; ?></option>
        <?php

        }
        ?>
        </select><br>



<!-- <input type="text" name="ud_carClass" value="<?php if (isset($carClass))echo $carClass; ?>"> -->


<input type="Submit" value="Update">
</form>

<?php
if (isset($_POST['ud_plate'])) {
try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE cars 
            SET Brand = :cbrand, Model = :cmodel, Status = :cstatus, carClass = :ccarClass 
            WHERE plateno = :cplate';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cplate', $_POST['ud_plate']);
    $stmt->bindValue(':cbrand', $_POST['ud_brand']);
    $stmt->bindValue(':cmodel', $_POST['ud_model']);
    $stmt->bindValue(':cstatus', $_POST['ud_status']);
    $stmt->bindValue(':ccarClass', $_POST['ud_carClass']);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo "You just updated car no: " . 
             " � click <a href='/qindex.php'>here</a> to go back";
    } else {
        echo "Nothing updated (either no such car, or values were unchanged).".
             " � click <a href='/qindex.php'>here</a> to go back";
    }

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}
}
?>
</body>

</html>