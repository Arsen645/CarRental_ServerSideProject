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
            <li><a href="cars/addCar/addCar.php">Insert cars</a></li>
            <li><a href="carClasses/insert/addClass.php">Insert carclass</a></li>
            <li><a href="carClasses/classesTable.php">carclasses</a></li>
            <li><a href="customers/InsertCustomer/addCustomer.php">Insert customers</a></li>
            <li><a href="">Home</a></li>
            <li><a href="cars/Delete/delete.php">delete car</a></li>
            <li><a href="myCars.php">my cars</a></li>
            <li><a href="" class="loginBtn">Register/Login</a></li>
            <li><a href="customerHomePage.php" class="loginBtn">cusHomePage</a></li>


        </ul>
    </nav>


    <section class="banner">
        <div class="bannerText">
            <h1>ELEVATE YOUR BUSINESS</h1>
            <p>Reliable fleet rental. Get 10+ vehicles today!</p>
            <button class="browseBtn">BROWSE FLEET</button>
        </div>
    </section>

    <div class="searchBar">
        <form action="searchPage.php" method="post">
            <input type="text" name="csearch" class="searchInput" placeholder="Search cars...">
            <input type="submit" name="search" value="search" class="searchButton">
        </form>
    </div>

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
WHERE cars.Status = "A" OR cars.Status = "C";';
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
                            

                            <form action="cars/Update/updateForm1.php" method="post">
                                <input type="hidden" name="ud_plate" value="<?= $row['PlateNo']; ?>">
                                <input type="submit" value="Update" class="add">
                            </form>
                            <form action="cars/Delete/deletecar.php" method="post">
                                <input type="hidden" name="plateno" value="<?= $row['PlateNo']; ?>">
                                <input type="submit" value="Delete" class="add">
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





</body>

</html>