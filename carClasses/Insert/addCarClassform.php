<?php include '../../connection.php';
?>

<div class="formContainer">
    <h2>Add a new car class</h2>
    <form action="addClass.php" method="post">
         ClassID: <!-- <input type="text" name="cclassid" value=""><br> -->
        <?php


        $sql = 'SELECT MAX(classid) as maxId
                FROM carClass';
        $result = $pdo->prepare($sql);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['maxId'] !== null) {
            echo $row['maxId'];
        } else {
            echo "No data found!";
        }

        ?><br><br>
        ClassName: <input type="text" name="classname"><br>
        Description: <input type="text" name="cdescription" value=""><br>
        MonthlyRate: <input type="text" name="cmonthlyrate"><br>
        <input type="submit" name="submitdetails" value="SUBMIT" class="submitBtn">
    </form>

</div>
</body>

</html>