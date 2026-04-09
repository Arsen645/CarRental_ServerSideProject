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
            <li><a href="/arsen/CarRental_ServerSideProject/qindex.php">index</a></li>
            <li><a href="/arsen/CarRental_ServerSideProject/cusHomePage.php">Home</a></li>
            <li><a href="myCars.php">my cars</a></li>
            <li><a href="login.php" class="loginBtn">Login</a></li>
            <li><a href="register.php" class="loginBtn">Register</a></li>
            </ul>
        </nav>


    <section class="banner">
        <div class="bannerText">
            <h1>ELEVATE YOUR BUSINESS</h1>
            <p>Reliable fleet rental. Get 10+ vehicles today!</p>
            <button class="browseBtn">BROWSE FLEET</button>
        </div>
    </section>

    <section class="ourCars">


        <h2>Our Cars</h2>
        <div class="fleetGrid">
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
                $result->execute();
                if ($result->rowCount() == 0) {
                    echo "No cars found";
                }
                while ($row = $result->fetch()) {
                    ?>
                    <div class="carCard">
                        <img src="images/carPlaceholder.avif" alt="Toyota Prius">
                        <h3><?php echo $row['Brand'] . ' ' . $row['Model']; ?></h3>
                        <p>Class: <?php echo $row['ClassName'] ?></p>
                        <p>Year: <?php echo $row['YearManufactured'] ?></p>
                        <p>Plate No: <?php echo $row['PlateNo'] ?></p>
                        <p class="price">Price: <?php echo $row['MonthlyRate']; ?>€ </p>
                        <div class="buttonGroup">
                            <!-- <button class="add">Add</button> -->
                            <form action="" method="post">
                                <input type="hidden" name="plateno" value="<?= $row['PlateNo']; ?>">
                                <input type="submit" value="Add" class="add"  name="add">
                          
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="plateno" value="<?= $row['PlateNo']; ?>">
                                <input type="submit" value="To Basket" class="add"  name="basket">
                          
                            </form>
                        </div>
                    </div>
                    <?php
            
                }
                //echo 'here';
            } catch (PDOException $e) {
                $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' .
                    $e->getLine();
                echo 'Database error: ' . $e->getMessage();
            }

            ?>
            




        </div>
    </section>
<?php
if (isset($_POST['add'])) {
    
try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE cars 
            SET Status = :cstatus
            WHERE plateno = :cplate';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cstatus', 'N');
    $stmt->bindValue(':cplate', $_POST['plateno']);
    $stmt->execute();
//For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
    

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}

}


if (isset($_POST['basket'])) {
    
try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE cars 
            SET Status = :cstatus
            WHERE plateno = :cplate';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cstatus', 'C');
    $stmt->bindValue(':cplate', $_POST['plateno']);
    $stmt->execute();
//For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
    

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}

}
?>
</body>

</html>