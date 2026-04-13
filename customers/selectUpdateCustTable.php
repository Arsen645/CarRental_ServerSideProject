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

    <table border="1">
        <tr>
            <th>CustomerID</th>
            <th>CorporateName</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>

        <?php if ($result->rowCount() > 0): ?>
        
        

            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['CustomerID']) ?></td>
                    <td><?= htmlspecialchars($row['CorporateName']) ?></td>
                    <td><?= htmlspecialchars($row['Email']) ?></td>
                    <td><?= htmlspecialchars($row['Phone']) ?></td>
                    <td><form action="Update/updateForm1.php" method="post">
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
