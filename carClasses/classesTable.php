<?php
include '../header.html';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM carclass';
    $result = $pdo->query($sql);
?>
<section class="ourCars">
    <h1>Car Classes </h1><br><br>
</section>


    <table>
        <tr>
            <th>ClassID</th>
            <th>ClassName</th>
            <th>Description</th>
            <th>MonthlyRate</th>

            
        </tr>

        <?php if ($result->rowCount() > 0): ?>
        
        

            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['ClassID']) ?></td>
                    <td><?= htmlspecialchars($row['ClassName']) ?></td>
                    <td><?= htmlspecialchars($row['Description']) ?></td>
                    <td><?= htmlspecialchars($row['MonthlyRate']) ?></td>
                    <td><form action="Update/updateForm1.php" method="post">
                                <input type="hidden" name="ClassID" value="<?= $row['ClassID']; ?>">
                                <input type="submit" value="Update" class="add">
                            </form></td>
                    <td><form action="Delete/deleteClass3.php" method="post">
                        <input type="hidden" name="ClassName" value="<?= $row['ClassName']; ?>">
                                <input type="hidden" name="ClassID" value="<?= $row['ClassID']; ?>">
                                <input type="submit" value="Delete" class="add">
                            </form></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="2">No classes found</td></tr>
        <?php endif; ?>
    </table>
    <div class="formContainer">
     <form action="Insert/addClass.php" method="post">                
        New class: <br><br>
       
        <input type="submit" name="submitdetails" value="Add" class="submitBtn">
     </form>
     </div>

<?php
} catch (PDOException $e) {
    echo 'Unable to connect to the database server: ' . $e->getMessage();
}

