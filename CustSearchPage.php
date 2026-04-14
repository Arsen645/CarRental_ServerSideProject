<?php include 'connection.php';
include 'customerHeader.html';
?>
    


    <div class="searchBar">
        <form action="" method="post">
            <input type="text" name="csearch" class="searchInput" placeholder="Search cars...">
            From: <input type="date" name="cStartDate" class="searchDate">
            To: <input type="date" name="cFinishDate" class="searchDate">
            <input type="submit" name="search" value="search" class="searchButton">
        </form>
    </div>

    <div class="fleetGrid">

    <?php
    if (isset($_POST['search'])) {
        $fromShow = true;
        try {
            $sql = 'SELECT cars.PlateNo,cars.Brand,cars.Model,cars.YearManufactured,
    carclass.ClassName,carclass.MonthlyRate, carclass.Description
FROM cars
JOIN carclass
ON cars.carClass = carclass.className
WHERE cars.Status != "D"
AND (cars.PlateNo LIKE :csearch
OR cars.Brand LIKE :csearch
OR cars.Model Like :csearch
OR cars.YearManufactured LIKE :csearch
OR carclass.Description LIKE :csearch
OR carclass.ClassName LIKE :csearch)
AND NOT EXISTS (
    SELECT *
    FROM rentals
    WHERE rentals.CarPlateNo = cars.PlateNo
    AND rentals.StartDate < :cfinish
    AND rentals.FinishDate > :cstart
    );';
            $result = $pdo->prepare($sql);
            $result->bindValue(':csearch', '%' . $_POST['csearch'] . '%');
            $result->bindValue(':cfinish', $_POST['cFinishDate'] );
            $result->bindValue(':cstart', $_POST['cStartDate'] );
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
                                <input type="hidden" name="cStartDate" value="<?= $_POST['cStartDate']; ?>">
                                <input type="hidden" name="cFinishDate" value="<?= $_POST['cFinishDate']; ?>">
                                <input type="submit" value="Rent" class="add"  name="add">
                          
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
<?php




if (isset($_POST['add'])) {

                try {


                    // add rental record
                    $sql = "INSERT INTO rentals (CustomerID,StartDate,FinishDate,CarPlateNo) 
            VALUES(:cCustomerID, :cStartDate, :cFinishDate, :cCarPlateNo)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':cCustomerID', 5);
                    $stmt->bindValue(':cStartDate', $_POST['cStartDate']);
                    $stmt->bindValue(':cFinishDate', $_POST['cFinishDate'] );
                    $stmt->bindValue(':cCarPlateNo', $_POST['plateno']);
            
                    $stmt->execute();
                    

                } catch (PDOException $e) {
                    echo 'Unable to process query: ' . $e->getMessage();
                }

            }
?>
</body>

</html>