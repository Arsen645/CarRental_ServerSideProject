<?php
include '../header.html';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT  * FROM rentals JOIN cars ON rentals.CarPlateNo = cars.plateno';
    $result = $pdo->query($sql);
?>
<section class="ourCars">
    <h1>Rentals </h1><br><br>
</section>


    <table border="1">
        <tr>
            <th>RentID</th>
            <th>CustomerID</th>
            <th>StartDate</th>
            <th>FinishDate</th>
            <th>CarPlateNo</th>
            <th>Brand</th>
            <th>Model</th>

            
        </tr>

        <?php if ($result->rowCount() > 0): ?>
        
        

            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= ($row['RentID']) ?></td>
                    <td><?= ($row['CustomerID']) ?></td>
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
