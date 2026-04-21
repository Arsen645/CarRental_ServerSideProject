<?php include 'connection.php';
include 'customerHeader.html';
?>
    


    <div class="searchBar">
        <form action="CustSearchPage.php" method="post">
            <div class='searchUnit searchText'>
                <input type="text" name="csearch" class="searchInput" placeholder="Search cars..." value = "<?php echo $_POST['csearch'] ?>"></div>
            <div class='searchUnit'>Year: 
            <!-- <input type="number" name="year" min="2000" max="2026" step="1" placeholder="Enter year" style="height: 30%;"> -->
            <select name="cyear" style="width: 100px;">
            <?php 
            $year = $_POST['cyear'] ?? '';
            for ($i = 2010; $i <= date("Y"); $i++) {  // date("Y") https://www.w3schools.com/php/php_date.asp
                $flag = ""; 
                if ($i == $year) {
                        $flag = 'selected';
                }?>
            <option value="<?= $i; ?>" <?php echo $flag ?>><?= $i ?>+</option> <?php } ?>
            </select></div>
            <div class='searchUnit'>Class: <select name="ccarClass" style="width: 130px;">
        <?php
        $carClass = $_POST['ccarClass'] ?? '';
        $sql = 'SELECT ClassName, description
                FROM carclass;';
        $result = $pdo->prepare($sql);
        $result->execute();
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $flag = "";
                if ($row["ClassName"] == $carClass) {
                        $flag = 'selected';
                }
        ?><option value="<?php echo $row['ClassName']; ?>" <?php echo $flag ?>><?php echo $row['ClassName'] . ' - ' .$row['description']; ?></option>
        <?php

        }
        ?>
        </select></div>
           <div class='searchUnit'> From: <input type="date" name="cStartDate" class="searchDate" value = "<?=  $_POST['cStartDate'] ?? '' ?>" required></div>
            <div class='searchUnit'>To: <input type="date" name="cFinishDate" class="searchDate" value = "<?=  $_POST['cFinishDate'] ?? '' ?>" required></div>
            <div class='searchUnit'><input type="submit" name="search" value="search" class="searchButton"></div>
        </form>
    </div>
<section class="ourCars">
    <div class="fleetGrid">

    <?php
    
    if (isset($_POST['search'])) {

        $fromShow = true;
        try {
            $sql = 'SELECT cars.PlateNo,cars.Brand,cars.Model,cars.YearManufactured,
    carclass.ClassName,carclass.Rate, carclass.Description
FROM cars
JOIN carclass
ON cars.carClass = carclass.className
WHERE cars.Status != "D"
AND (cars.PlateNo LIKE :csearch
OR cars.Brand LIKE :csearch
OR cars.Model Like :csearch
OR cars.YearManufactured >= :cyear
OR carclass.Description LIKE :csearch
OR carclass.ClassName = :ccarClass)
AND NOT EXISTS (
    SELECT *
    FROM rentals
    WHERE rentals.CarPlateNo = cars.PlateNo
    AND rentals.StartDate < :cfinish
    AND rentals.FinishDate > :cstart
    );';
            $result = $pdo->prepare($sql);
            $result->bindValue(':csearch', '%' . $_POST['csearch'] . '%');
            $result->bindValue(':cyear', $_POST['cyear']);
            $result->bindValue(':ccarClass', $_POST['ccarClass'] );
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
                        <p class="price">Price/day: <?php echo $row['Rate']; ?>€ </p>
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
</section>
<?php




if (isset($_POST['add'])) {

                try {


                    // add rental record
                    $sql = "INSERT INTO rentals (CustomerID,StartDate,FinishDate,CarPlateNo) 
            VALUES(:cCustomerID, :cStartDate, :cFinishDate, :cCarPlateNo)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':cCustomerID', $_SESSION['user_id']);
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