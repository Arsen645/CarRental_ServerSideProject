<?php include 'connection.php';
?>
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
            <li><a href="insert/add.php">Insert carclass</a></li>
            <li><a href="insert/addCustomer.php">Insert customers</a></li>
            <li><a href="/arsen/CarRental_ServerSideProject/qindex.php">Home</a></li>
            <li><a href="myCars.php">my cars</a></li>
            <li><a href="" class="loginBtn">Register/Login</a></li>
            <li><a href="customerHomePage.php" class="loginBtn">cusHomePage</a></li>


        </ul>
    </nav>
    


    <div class="searchBar">
        <form action="searchPage.php" method="post">
            <input type="text" name="csearch" class="searchInput" placeholder="Search cars...">
            <input type="submit" name="search" value="search" class="searchButton">
        </form>
    </div>

    <div class="fleetGrid">

    <?php
    if (isset($_POST['search'])) {
        $fromShow = true;
        try {
            $sql = 'SELECT cars.PlateNo,cars.Brand,cars.Model,cars.YearManufactured,
    cars.Status,carclass.ClassName,carclass.MonthlyRate
FROM cars
JOIN carclass 
ON cars.carClass = carclass.className
WHERE cars.PlateNo LIKE :csearch
OR cars.Brand LIKE :csearch
OR cars.Model Like :csearch
OR cars.YearManufactured LIKE :csearch
OR carclass.ClassName LIKE :csearch;';
            $result = $pdo->prepare($sql);
            $result->bindValue(':csearch', '%' . $_POST['csearch'] . '%');
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
    }
    ?>
</div>

</body>

</html>