<?php $pdo = new PDO('mysql:host=localhost;dbname=CarRentalSys; charset=utf8', 'root', ''); ?>
<!DOCTYPE html>
<html lang='en'>
<head>
<title></title>
<meta charset='utf-8'>
</head>
<body>
<h1> update car form two </h1>
<?php $sql = 'SELECT * FROM cars where PlateNo = :cPlateNo';
$result = $pdo->prepare($sql);
$result->bindValue(':cPlateNo', $_POST['cPlateNo']);
$result->execute();
$row = $result->fetch()
    ?>
<form action="delete.php" method="post">
Car Plate Number: <input type="text" name="cPlateNo" value="<?php echo '$row["PlateNo"]'?> "><br>
Car Plate Number: <input type="text" name="cPlateNo" value="<?php echo '$row["PlateNo"]'?> "><br>
Car Plate Number: <input type="text" name="cPlateNo" value="<?php echo '$row["PlateNo"]'?> "><br>
Car Plate Number: <input type="text" name="cPlateNo" value="<?php echo '$row["PlateNo"]'?> "><br>
Car Plate Number: <input type="text" name="cPlateNo" value="<?php echo '$row["PlateNo"]'?> "><br>
Car Plate Number: <input type="text" name="cPlateNo" value="<?php echo '$row["PlateNo"]'?> "><br>
<input type="submit" name="submitdetails" value="SUBMIT" >
</form>
</body>
</html>