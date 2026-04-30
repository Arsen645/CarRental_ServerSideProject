<?php include 'connection.php';
include 'customerHeader.html';

$cutsId = $_SESSION['user_id'];

?>

<section class="ourCars">


    <h2>Renting Cars</h2>
    <div class="fleetGrid">
        <?php
        try {

            $sql = 'SELECT cars.PlateNo,cars.Brand,cars.Model,cars.YearManufactured,
    cars.Status,carclass.ClassName,carclass.Rate,rentals.StartDate,
    rentals.FinishDate
FROM cars
JOIN carclass 
ON cars.carClass = carclass.className
JOIN rentals 
ON rentals.CarPlateNo = cars.PlateNo
WHERE rentals.CustomerID = :customerId
AND rentals.FinishDate >= CURDATE();';
            $result = $pdo->prepare($sql);
            $result->bindValue(':customerId', $cutsId);
            $result->execute();
            if ($result->rowCount() == 0) { 
                echo "You do not have future reservations";
            }
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="carCard">
                    <img src="images/carPlaceholder.avif" alt="Toyota Prius">
                    <h3>
                        <?php echo $row['Brand'] . ' ' . $row['Model']; ?>
                    </h3>
                    <p>Class:
                        <?php echo $row['ClassName'] ?>
                    </p>
                    <p>Year:
                        <?php echo $row['YearManufactured'] ?>
                    </p>
                    <p>Plate No: <?php echo $row['PlateNo'] ?></p>
                    <p class="price">Price per day:
                        <?php echo $row['Rate']; ?>€
                    </p>
                    <p>Rent from:
                        <?php echo date("d-m", strtotime($row['StartDate'])) ?>
                    </p>
                    <p>to:
                        <?php echo date("d-m", strtotime($row['FinishDate'])) ?>
                    </p>
                    <div class="buttonGroup">


                        <form action="" method="post">
                            <input type="hidden" name="plateno" value="<?= $row['PlateNo']; ?>">
                            <input type="submit" value="Remove" class="add" name="remove">
                        </form>

                    </div>
                </div>
                <?php

            }
            //echo 'here';
        } catch (PDOException $e) {
            echo 'No cars matched the query';
        }

        ?>



    </div>
</section>

          



        <?php 
include 'footer.html';
?>
    </body>

    </html>