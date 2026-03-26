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
            <li><a href="Update/selectUpdate.php">update car</a></li>
            <li><a href="Delete/delete.php">delete car</a></li>
            <li><a href="myCars.php">my cars</a></li>
            <li><a href="" class="loginBtn">Register/Login</a></li>
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
                        <p class="price">Price: <?php echo $row['MonthlyRate']; ?>€ </p>
                        <div class="buttonGroup">
                            <!-- <button class="add">Add</button> -->
                            <form action="addButton" method="post">
                                <input type="hidden" name="plateno" value="<?= $row['PlateNo']; ?>">
                                <input type="submit" value="Add" class="add">
                                <?php
//                                 if (isset($_POST(addButton))
// try {
//     $sql = 'UPDATE cars 
//             SET Status = :cstatus
//             WHERE plateno = :cplate';

//     $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(':cplate', $row['PlateNo']);
//     $stmt->bindValue(':cstatus', 'N');
//     $stmt->execute();
//     if ($stmt->rowCount() > 0) {
//     }

// } catch (PDOException $e) {
//     echo 'Unable to process query: ' . $e->getMessage();
// }
?>
                            </form>

                            <form action="Update/updCarDetails1.php" method="post">
                                <input type="hidden" name="plateno" value="<?= $row['PlateNo']; ?>">
                                <input type="submit" value="Update" class="add">
                            </form>
                            <form action="Delete/deletecar.php" method="post">
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