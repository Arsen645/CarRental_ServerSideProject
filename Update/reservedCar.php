<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrentalsys;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE cars 
            SET Status = :cstatus
            WHERE plateno = :cplate';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':cplate', $_POST['plateno']);
    $stmt->bindValue(':cstatus', 'N');
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    }

} catch (PDOException $e) {
    echo 'Unable to process query: ' . $e->getMessage();
}
?>