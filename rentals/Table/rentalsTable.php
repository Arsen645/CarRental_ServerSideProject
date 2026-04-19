<?php
include '../../header.html';
include '../../connection.php';

try {

    $sql = 'SELECT  rentals.RentID,
    rentals.CustomerID,
    customers.CorporateName AS CustomerName,
    rentals.StartDate,
    rentals.FinishDate,
    rentals.CarPlateNo,
    cars.Brand,
    cars.Model
     FROM rentals JOIN cars ON rentals.CarPlateNo = cars.plateno
            JOIN customers ON rentals.CustomerID = customers.CustomerID';
    $result = $pdo->query($sql);
?>
<section class="ourCars">
    <h1>Rentals </h1><br><br>
</section>


    <table>
        <tr>
            <th>Rent ID</th>
            <th>Customer ID</th>
            <th>Customer name</th>
            <th>Start Date</th>
            <th>Finish Date</th>
            <th>Car Plate</th>
            <th>Brand</th>
            <th>Model</th>

            
        </tr>

        <?php if ($result->rowCount() > 0): ?>
        
        

            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= ($row['RentID']) ?></td>
                    <td><?= ($row['CustomerID']) ?></td>
                    <td><?= ($row['CustomerName']) ?></td>
                    <td><?= ($row['StartDate']) ?></td>
                    <td><?= ($row['FinishDate']) ?></td>
                    <td><?= ($row['CarPlateNo']) ?></td>
                    <td><?= ($row['Brand']) ?></td>
                    <td><?= ($row['Model']) ?></td>

                    
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="2">No Rents found</td></tr>
        <?php endif; ?>
    </table>
    

<?php
} catch (PDOException $e) {
    echo 'Unable to connect to the database server: ' . $e->getMessage();
}
