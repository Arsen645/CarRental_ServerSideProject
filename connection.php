<?php try {
$pdo = new PDO('mysql:host=localhost;dbname=carRentalSys; charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' .
$e->getLine();
echo 'Database error: ' . $e->getMessage();
}
session_start();
?>