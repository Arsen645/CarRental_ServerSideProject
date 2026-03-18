<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car rental</title>
    <link rel="stylesheet" href="stylecss.css">
</head>
<body>

    
        <nav class="navbar">
            <div class="logo">FLEET RENTAL</div>
            <ul class="navLinks">
                <li><a href="insert/addCar.php">Insert cars</a></li>
                <li><a href="insert/add.php">Insert carclass</a></li>
                <li><a href="insert/addCustomer.php">Insert customers</a></li>
                <li><a href="">Home</a></li>
                <li><a href="">Our Cars</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="" class="loginBtn">Register/Login</a></li>
            </ul>
        </nav>
    

    <section class="banner">
        <div class="bannerText">
            <h1>ELEVATE YOUR BUSINESS</h1>
            <p>Reliable fleet rental for. Get 10+ vehicles today!</p>
            <button class="browseBtn">BROWSE FLEET</button>
        </div>
    </section>

    <section class="ourCars">


        <h2>Our Cars</h2>
        <div class="fleet-grid">
                    <?php 
try {
$pdo = new PDO('mysql:host=localhost;dbname=carRentalSys; charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT cars.PlateNo,cars.Brand,cars.Model,cars.YearManufactured,
    cars.Status,carclass.ClassName,carclass.MonthlyRate
FROM cars
JOIN carclass 
ON cars.carClass = carclass.className
WHERE cars.Status = "A";';
$result = $pdo->prepare($sql);
$result ->execute();
if ($result->rowCount() == 0) {
    echo "No cars found";
}
while($row = $result->fetch()) {
    ?>
    <div class="carCard">
    <img src="images/carPlaceholder.avif" alt="Toyota Prius">
    <h3><?php echo $row['Brand'] . ' ' . $row['Model'];?></h3>
    <p>Year: <?php echo $row['YearManufactured']?></p>
    <p class="price">Price: <?php echo $row['MonthlyRate'];?>€ </p>
    <button class="add">Add</button>
    </div>
    <?php
    // echo $row['PlateNo'].', '.$row['Brand'].', '.$row['Model'].', '.
    // $row['Year'].', '.$row['Status'].', '.$row['ClassName'].', '.
    // $row['MonthlyRate'].'$<br>';
    
}
//echo 'here';
}
catch (PDOException $e) {
$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' .
$e->getLine();
echo 'Database error: ' . $e->getMessage();
}

?>
            <div class="carCard">
                <img src="" alt="Toyota Prius">
                <h3>Toyota Prius</h3>
                <p>Year: 2024 | Seats: 5</p>
                <p class="price">Price/Day: <strong>€190.00</strong></p>
                <button class="add">Add</button>
            </div>
            
            <div class="carCard">
                <img src="" alt="Mercedes E-Class">
                <h3>Mercedes E-Class</h3>
                <p>Year: 2024 | Seats: 5</p>
                <p class="price">Price/Day: <strong>€190.00</strong></p>
                <button class="add">Add</button>
            </div>

            

           
        </div>
    </section>

</body>
</html>