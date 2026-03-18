<?php try {
$pdo = new PDO('mysql:host=localhost;dbname=carRentalSys; charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT classname FROM carclass';
$result = $pdo->prepare($sql);
$result ->execute();
while($row = $result->fetch()) {
    echo $row['classname'].'<br>';
}
//echo 'here';
}
catch (PDOException $e) {
$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' .
$e->getLine();
}



try {
$pdo = new PDO('mysql:host=localhost;dbname=carRentalSys; charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT count(ClassName) FROM CarClass where ClassName = :cname';
$result = $pdo->prepare($sql);
$result->bindValue(':cname', $_POST['send']);
$result->execute();
if($result->fetchColumn() > 0)
{
$sql = 'SELECT ClassName, Description, MonthlyRate FROM CarClass where ClassName = :cname';
$result = $pdo->prepare($sql);
$result->bindValue(':cname', $_POST['send']);
$result->execute();
while ($row = $result->fetch()) {
echo $row['ClassName'] . '  ' . $row['Description'] . '  ' . $row['MonthlyRate'] . '$<br>';
//echo 'yes';

}
}
else {
print "No rows matched the query.";
}}
catch (PDOException $e) {
$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' .
$e->getLine();
}





 
?>


<form method="POST" action="selectOne.php">
    <input type="text" name="send">
    <input type="submit" value="Search">
</form>
<br><br><br>

<?php 
try {
$pdo = new PDO('mysql:host=localhost;dbname=carRentalSys; charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT cars.PlateNo,cars.Brand,cars.Model,cars.Year,cars.Status,carclass.ClassName,
    carclass.MonthlyRate
FROM cars
JOIN carclass 
ON cars.CarClassID = carclass.ClassID;';
$result = $pdo->prepare($sql);
$result ->execute();
while($row = $result->fetch()) {
    echo $row['PlateNo'].', '.$row['Brand'].', '.$row['Model'].', '.
    $row['Year'].', '.$row['Status'].', '.$row['ClassName'].', '.
    $row['MonthlyRate'].'$<br>';
    
}
//echo 'here';
}
catch (PDOException $e) {
$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' .
$e->getLine();
}

?>

