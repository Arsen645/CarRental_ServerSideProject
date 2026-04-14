<?php include 'connection.php';
include 'customerHeader.html';
?>

<section class="ourCars">


    <h2>Renting Cars</h2>
    <div class="fleetGrid">
        <?php
        try {

            $sql = 'SELECT cars.PlateNo,cars.Brand,cars.Model,cars.YearManufactured,
    cars.Status,carclass.ClassName,carclass.MonthlyRate
FROM cars
JOIN carclass 
ON cars.carClass = carclass.className
WHERE cars.Status = "N";';//not available for renting. means currently renting
            $result = $pdo->prepare($sql);
            $result->execute();
            if ($result->rowCount() == 0) {
                echo "No cars found";
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
                    <p class="price">Price:
                        <?php echo $row['MonthlyRate']; ?>€
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
            $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' .
                $e->getLine();
            echo 'Database error: ' . $e->getMessage();
        }

        ?>



    </div>
</section>
<section class="myTotals">
    <h2>total rent:
        <?php
        $sql = 'SELECT sum(carclass.MonthlyRate) as totalRent
FROM cars
JOIN carclass 
ON cars.carClass = carclass.ClassName
WHERE cars.Status = "N";';
        $result = $pdo->prepare($sql);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo $row['totalRent'];
        ?>
        €
    </h2>




            
<?php

        //     if (isset($_POST['remove'])) {

        //         try {
        //             $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
        //             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //             $sql = 'UPDATE cars 
        //     SET Status = :cstatus
        //     WHERE plateno = :cplate';

        //             $stmt = $pdo->prepare($sql);
        //             $stmt->bindValue(':cstatus', 'A');
        //             $stmt->bindValue(':cplate', $_POST['plateno']);
        //             $stmt->execute();

                    


        //             // add finish date to rental record
        //             $sql = "UPDATE rentals 
        // SET FinishDate = :cFinishDate
        // WHERE RentID = :cRentID";
        //     $stmt = $pdo -> prepare($sql);
        //     $stmt->bindValue(':cFinishDate', date('Y-m-d'));
        //     $stmt->bindValue(':cRentID', $_POST['plateno']);
            
        //             $stmt->execute();
        //             $rentalID = (int) $pdo->lastInsertId();

        //         } catch (PDOException $e) {
        //             echo 'Unable to process query: ' . $e->getMessage();
        //         }





        //     }
            ?>



        
    </body>

    </html>