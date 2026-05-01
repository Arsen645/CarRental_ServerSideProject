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


    <?php include 'admNavbar.php'; ?>
    


    <div class="searchBar">
        <form action="searchPage.php" method="post">
            <input type="text" name="csearch" class="searchInput" placeholder="Enter brand, model, or description..." value = "<?php echo $_POST['csearch'] ?>">
            
            <input type="submit" name="search" value="search" class="searchButton">
        </form>
    </div>
<section class="ourCars">
    <div class="fleetGrid">

    <?php
    if (isset($_POST['search'])) {
        $fromShow = true;
        try {
            $sql = "SELECT cars.PlateNo,cars.Brand,cars.Model,cars.YearManufactured,
    cars.Status,carclass.ClassName,carclass.Rate, carclass.Description
FROM cars
JOIN carclass 
ON cars.carClass = carclass.className
WHERE cars.Status != 'D' 
AND (cars.PlateNo LIKE :csearch
OR cars.Brand LIKE :csearch
OR cars.Model Like :csearch
OR cars.YearManufactured LIKE :csearch
OR carclass.Description LIKE :csearch
OR carclass.ClassName LIKE :csearch);";
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
                    <p class="price">Price: <?php echo $row['Rate']; ?>€ </p>
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
            echo 'Lost connection to database';
        }
    }
    ?>
</div>
</section>
<?php 
include 'footer.html';
?>
</body>

</html>