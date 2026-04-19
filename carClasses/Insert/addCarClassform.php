<?php include '../../connection.php';
?>

<div class="formContainer">
    <h2>Add a new car class</h2>
    <form action="addClass.php" method="post">
        <br>
        ClassName: <input type="text" name="classname"><br>
        Description: <input type="text" name="cdescription" value=""><br>
        Price/day: <input type="text" name="crate"><br>
        <input type="submit" name="submitdetails1" value="SUBMIT" class="submitBtn">
    </form>

</div>
</body>

</html>