<?php
include '../../header.html';
include '../../connection.php';

function validateCarPlate($plateno)
{
    $pattern = '/^(\d+)-(\w+)-(\d+)$/';
    $result = preg_match($pattern, $plateno);

    return $result;
}
if (isset($_POST['submitCar'])) {
    try {


        $cplateNo = htmlspecialchars(trim($_POST['cplate']));
        // $cbrand = htmlspecialchars(trim($_POST['cbrand']));

        $sql = 'SELECT *
FROM brand
WHERE brandid = :brand;';
        $result = $pdo->prepare($sql);
        $result->bindValue(':brand', $_POST['cbrand']);
        $result->execute();
        $row = $result->fetch();

        $cbrand = $row['brandname'];


        $cmodel = htmlspecialchars(trim($_POST['cmodel']));
        $cyear = htmlspecialchars(trim($_POST['cyear']));
        $ccarClass = htmlspecialchars(trim($_POST['ccarClass']));
        $cstatus = 'A';

        if (
            $cplateNo == '' or $cbrand == '' or $cmodel == '' or $cyear == ''
            or $ccarClass == ''
        ) {
            echo ("You did not complete the insert form correctly <br> ");
        } elseif (!validateCarPlate($cplateNo)) {
            echo ("Plate number is not valid <br> ");
        } elseif ($cyear < 1900 || $cyear > 2026) {
            echo ("Year is not valid");
        } else {

            $pdo = new PDO('mysql:host=localhost;dbname=CarRentalSys; charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO cars (plateNo,brand,model,yearManufactured,status,carClass) 
            VALUES(:cplateNo, :cbrand, :cmodel, :cyear, :cstatus, :ccarClass)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':cplateNo', $cplateNo);
            $stmt->bindValue(':cbrand', $cbrand);
            $stmt->bindValue(':cmodel', $cmodel);
            $stmt->bindValue(':cyear', $cyear);
            $stmt->bindValue(':cstatus', $cstatus);
            $stmt->bindValue(':ccarClass', $ccarClass);

            $stmt->execute();
            echo "Added try doing another";
        }
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
        echo $output;
    }
}

include 'addCarform.php'
    ?>