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
WHERE cars.Status = "N";';
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



    <section class="ourCars">


        <h2>My basket</h2>
        <div class="fleetGrid">
            <?php
            try {

                $sql = 'SELECT cars.PlateNo,cars.Brand,cars.Model,cars.YearManufactured,
    cars.Status,carclass.ClassName,carclass.MonthlyRate
FROM cars
JOIN carclass 
ON cars.carClass = carclass.className
WHERE cars.Status = "C";';
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
                        <p class="price">Price:
                            <?php echo $row['MonthlyRate']; ?>€
                        </p>
                        <div class="buttonGroup">
                            <form action="" method="post">
                                <input type="hidden" name="plateno" value="<?= $row['PlateNo']; ?>">
                                <input type="submit" value="Add to rentals" class="add" name="add">

                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="cplateno" value="<?= $row['PlateNo']; ?>">
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
            

                    // add rental record
                    $sql = "INSERT INTO rentals (CustomerID,StartDate,Status) 
            VALUES(:cCustomerID, :cStartDate,:cstatus)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':cCustomerID', 1);
                    $stmt->bindValue(':cStartDate', date('d-m-y'));
                    $stmt->bindValue(':cstatus', 'A'); //status A = Active
            
                    $stmt->execute();
                    $rentalID = (int) $pdo->lastInsertId();
                    //add rentalcar record
                    $sql = "INSERT INTO rentalcars (RentID,PlateNo) 
            VALUES(:cRentID, :cPlateNo)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':cRentID', $rentalID);
                    $stmt->bindValue(':cPlateNo', $_POST['plateno']);

                    $stmt->execute();

                } catch (PDOException $e) {
                    echo 'Unable to process query: ' . $e->getMessage();
                }

            }


            if (isset($_POST['remove'])) {

                try {
                    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = 'UPDATE cars 
            SET Status = :cstatus
            WHERE plateno = :cplate';

                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':cstatus', 'A');
                    $stmt->bindValue(':cplate', $_POST['plateno']);
                    $stmt->execute();

                    $sql = 'SELECT * 
                    FROM rentalcars 
                    WHERE PlateNo = :cPlate';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':cplate', $_POST['plateno']);
                    $result = $pdo->query($sql);

                    if ($result->rowCount() > 0):



                        while ($row = $result->fetch(PDO::FETCH_ASSOC)):

                            $plate = $row['RentID'];
                        endwhile;
                    endif;


                    // add rental record
                    $sql = "UPDATE rentals 
        SET FinishDate = :cFinishDate, Status = :cstatus
        WHERE RentID = :cRentID";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindValue(':cFinishDate', date('d-m-y'));
            $stmt->bindValue(':cstatus', 'N'); //status N == Not Active
            
                    $stmt->execute();
                    $rentalID = (int) $pdo->lastInsertId();

                } catch (PDOException $e) {
                    echo 'Unable to process query: ' . $e->getMessage();
                }





            }
            ?>



        </div>
    </section>
    </body>

    </html>