<?php
include '../header.html';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM customers';
    $result = $pdo->query($sql);
?>
<section class="ourCars">
    <h1>Customers </h1><br><br>
</section>


    <table >
        <tr>
            <th>CustomerID</th>
            <th>CorporateName</th>
            <th>Email</th>
            <th>Phone</th>

            
        </tr>

        <?php if ($result->rowCount() > 0): ?>
        
        

            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= ($row['CustomerID']) ?></td>
                    <td><?= ($row['CorporateName']) ?></td>
                    <td><?= ($row['Email']) ?></td>
                    <td><?= ($row['Phone']) ?></td>
                    <td><form action="updateCustomer/updateCustomerForm1.php" method="post">
                                <input type="hidden" name="CustomerID" value="<?= $row['CustomerID']; ?>">
                                <input type="submit" value="Update" class="add">
                            </form></td>
                    <td><form action="Delete/deleteCustomer3.php" method="post">
                        <input type="hidden" name="CorporateName" value="<?= $row['CorporateName']; ?>">
                                <input type="hidden" name="CustomerID" value="<?= $row['CustomerID']; ?>">
                                <input type="submit" value="Delete" class="add">
                            </form></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="2">No customers found</td></tr>
        <?php endif; ?>
    </table>
    

<?php
} catch (PDOException $e) {
    echo 'Unable to connect to the database server: ' . $e->getMessage();
}

include 'updateCustomer/whotoupdate.html';
