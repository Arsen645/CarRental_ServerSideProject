<?php 
include 'connection.php';
include 'customerHeader.html';
?>


    <section class="banner">
        <div class="bannerText">
            <h1>ELEVATE YOUR BUSINESS</h1>
            <p>Reliable fleet rental. Get 10+ vehicles today!</p>
            <button class="browseBtn">BROWSE FLEET!</button>
        </div>
    </section>

    <div class="searchBar">
        <form action="CustSearchPage.php" method="post">
            <input type="text" name="csearch" class="searchInput" placeholder="Search cars...">
            From: <input type="date" name="cStartDate" class="searchDate">
            To: <input type="date" name="cFinishDate" class="searchDate">
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
    cars.Status,carclass.ClassName,carclass.rate
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
                        <p class="price">Price: <?php echo $row['rate']; ?>€ </p>
                        <!-- <div class="buttonGroup">
                             <button class="add">Add</button> 
                            <form action="" method="post">
                                <input type="hidden" name="plateno" value="<?php //$row['PlateNo']; ?>">
                                <input type="submit" value="Add" class="add"  name="add">
                          
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="plateno" value="<?php //$row['PlateNo']; ?>">
                                <input type="submit" value="To Basket" class="add"  name="basket">
                          
                            </form>
                        </div> -->
                    </div>
                    <?php
            
                }
                //echo 'here';
            } catch (PDOException $e) {
                $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' .
                    $e->getLine();
                echo 'Database error: ' . $e->getMessage();
            }

            if (isset($_SESSION['cust_message'])) {
    echo "<script>alert('" . $_SESSION['cust_message'] . "');</script>";
    unset($_SESSION['cust_message']);
}

            ?>
            




        </div>
    </section>

</body>

</html>