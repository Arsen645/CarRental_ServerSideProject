<?php
include 'header.html';
function validateCarPlate ($first, $reg, $last) {
    if (!is_int($first) && !$first >= 0 && !$first <= 262) {
        return false;
    } elseif ($reg == 'A' && $reg == 'N') {
        return false;

    } elseif (!is_int($last) && !$last >= 0) {
        return false;
    }
    return true;
}
if (isset($_POST['submitCar'])) {
    try {
        

        $cplateFirst = htmlspecialchars(trim($_POST['cplateFirst']));
        $cplateLast = htmlspecialchars(trim($_POST['cplateLast']));
        $cstatusReg = htmlspecialchars(trim($_POST['cstatusReg']));
        $cplateNo = $cplateFirst + '-' + $cplateReg + '-' + $cplateLast;
        $cbrand = htmlspecialchars(trim($_POST['cbrand']));
        $cmodel = htmlspecialchars(trim($_POST['cmodel']));
        $cyear = htmlspecialchars(trim($_POST['cyear']));
        $ccarClass = htmlspecialchars(trim($_POST['ccarClass']));
        $cstatus = 'A';

        if ($cplateNo == '' or $cbrand == '' or $cmodel == '' or $cyear == ''
            or $ccarClass == '') {
            echo ("You did not complete the insert form correctly <br> ");
        } elseif (!validateCarPlate($cplateNo,$cstatusReg,$cplateLast)) {
            echo ("Plate number is not valid <br> ");
        } elseif (!$cyear>1900 && !$cyear < 2026) {
            echo ("Year is not valid");
        }
        else {
            
            $pdo = new PDO('mysql:host=localhost;dbname=CarRentalSys; charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO cars (cplateNo,cbrand,cmodel,cyear,cstatus,ccarClass) 
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

include 'addCarform.html'
    ?>