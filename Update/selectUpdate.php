<?php
include '../header.html';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM cars';
    $result = $pdo->query($sql);
?>
    <b>A Quick View</b><br><br>

    <table border="1">
        <tr>
            <th>PlateNo</th>
            <th>Brand</th>
            <th>Model</th>
            <th>YearManufactured</th>
            <th>Status</th>
            <th>carClass</th>
        </tr>

        <?php if ($result->rowCount() > 0): ?>
        
        

            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['PlateNo']) ?></td>
                    <td><?= htmlspecialchars($row['Brand']) ?></td>
                    <td><?= htmlspecialchars($row['Model']) ?></td>
                    <td><?= htmlspecialchars($row['YearManufactured']) ?></td>
                    <td><?= htmlspecialchars($row['Status']) ?></td>
                    <td><?= htmlspecialchars($row['carClass']) ?></td>
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

include 'whotoupdate.html';
