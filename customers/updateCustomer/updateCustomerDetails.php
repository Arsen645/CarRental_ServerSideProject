<?php include '../../connection.php'; ?>

<div class="formContainer">
    <h2>Update customer information</h2>
<form action="updatedCustomer2.php" method="post">
<input type="hidden" name="CustomerID" value="<?php echo $CustomerID; ?>">

CorporateName: <input type="text" name="CorporateName" value="<?php if (isset($CorporateName)) echo $CorporateName; ?>"><br>
Email: <input type="text" name="Email" value="<?php if (isset($Email)) echo $Email; ?>"><br>
Phone: <input type="text" name="Phone" value="<?php if (isset($Phone))echo $Phone; ?>"><br>
<br>





<input type="Submit" value="Update" class="submitBtn">
</form>
</div>
</body>

</html>