<?php include '../../connection.php'; ?>

<div class="formContainer">
    <h2>Update car class</h2>
<form action="updated2.php" method="post">
<input type="hidden" name="cClassID" value="<?php echo $ClassID; ?>">
<p>ClassID: <?php echo $ClassID; ?></p><br>
ClassName: <input type="text" name="cClassName" value="<?php if (isset($ClassName)) echo $ClassName; ?>"><br>
Description: <input type="text" name="cDescription" value="<?php if (isset($Description))echo $Description; ?>"><br>
<br>
Monthly Rate: <input type="text" name="cMonthlyRate" value="<?php if (isset($MonthlyRate))echo $MonthlyRate; ?>"><br>





<input type="Submit" value="Update" class="submitBtn">
</form>
</div>
</body>

</html>