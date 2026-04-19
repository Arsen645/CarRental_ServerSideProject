<?php include '../../connection.php'; 
?>

<div class="formContainer">
    <h2>Update car class</h2>
<form action="updated2.php" method="post">
<input type="hidden" name="cClassID" value="<?php echo $ClassID; ?>">
<p>ClassID: <?php echo $ClassID; ?></p><br>
ClassName: <input type="text" name="cClassName" value="<?php if (isset($ClassName)) echo $ClassName; ?>"><br>
Description: <input type="text" name="cDescription" value="<?php if (isset($Description))echo $Description; ?>"><br>

 Rate: <input type="text" name="cRate" value="<?php if (isset($Rate))echo $Rate; ?>"><br>





<input type="Submit" value="Update" class="submitBtn">
</form>
</div>


<?php
// if($_SERVER['REQUEST_METHOD'] === 'POST') {
// try {

//     $sql = 'UPDATE carclass 
//             SET ClassName = :cClassName, Description = :cDescription, Rate = :cRate 
//             WHERE ClassID = :cClassID';

//     $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(':cClassID', $_POST['cClassID']);
//     $stmt->bindValue(':cClassName', $_POST['cClassName']);
//     $stmt->bindValue(':cDescription', $_POST['cDescription']);
//     $stmt->bindValue(':cRate', $_POST['cRate']);
//     $stmt->execute();
// //For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
//     if ($stmt->rowCount() > 0) {
//         echo "<script> alert('You just updated car class no: " . $_POST['cClassID'] . "'); </script>";
//     } else {
//         echo "<script> alert('Nothing updated (either no such car class, or values were unchanged).'); </script>";
//     }

// } catch (PDOException $e) {
//     echo 'Unable to process query: ' . $e->getMessage();
// }
// }
?>
</body>

</html>