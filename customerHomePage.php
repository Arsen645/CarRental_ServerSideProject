<?php 
include 'connection.php';
include 'customerHeader.html';
?>


    <section class="banner">
        <div class="bannerText">
            <h1>ELEVATE YOUR VACATION</h1>
            <p>Reliable car rental. Get 10+ vehicles today!</p>
            <button class="browseBtn">BROWSE FLEET!</button>
        </div>
    </section>

    <div class="searchBar">
        <form action="CustSearchPage.php" method="post">
            <div class='searchUnit searchText'><input type="text" name="csearch" class="searchInput" placeholder="Enter brand, model, or description..."></div>
            <div class='searchUnit'>Year: 
            <!-- <input type="number" name="year" min="2000" max="2026" step="1" placeholder="Enter year" style="height: 30%;"> -->
            <select name="cyear" style="width: 100px;">
            <?php for ($i = 2010; $i <= date("Y"); $i++) {  // date("Y") https://www.w3schools.com/php/php_date.asp ?>
            <option value="<?= $i ?>"><?php echo $i ?>+</option> <?php } ?>
            </select></div>
            <div class='searchUnit'>Class: <select name="ccarClass" style="width: 130px;">
        <?php
        $sql = 'SELECT ClassName, description
                FROM carclass;';
        $result = $pdo->prepare($sql);
        $result->execute();
        if ($result->rowCount() == 0) {
            echo "No cars found";
        }
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        ?><option value="<?php echo $row['ClassName']; ?>"><?php echo $row['ClassName'] . ' - ' .$row['description']; ?></option>
        <?php

        }
        ?>
        </select></div>
           <div class='searchUnit'> From: <input type="date" name="cStartDate" class="searchDate" value="<?= date("Y-m-d"); ?>" required></div>
            <div class='searchUnit'>To: <input type="date" name="cFinishDate" class="searchDate" value="<?= date("Y-m-d"); ?>" required></div>
            <div class='searchUnit'><input type="submit" name="search" value="search" class="searchButton"></div>
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
<?php 
include 'footer.html';
?>
</body>

</html>