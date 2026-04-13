<?php include 'connection.php';
session_start();
 ?>
 <!DOCTYPE html>
<html lang='en'>
  <head>
    <title></title>
    <meta charset='utf-8'>
        <link rel="stylesheet" href="/arsen/carrental_serversideproject/stylecss.css">

     </head>
  <body> 
    <nav class="navbar">
            <div class="logo">FLEET RENTAL</div>
            <ul class="navLinks">
                <li><a href="/arsen/carrental_serversideproject/qindex.php">Home</a></li>
            </ul>
        </nav>



<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = $_POST['customerName'];
$password = $_POST['password'];

// Get user
$stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?");
$stmt->execute([$name]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
$_SESSION['user_id'] = $user['id'];

echo "Login successfull";

} else {
echo "Invalid name or password";

} 
}
?>
<div class="formContainer">

<form method="POST">
<input type="text" name="customerName" placeholder="Name" required><br>
<input type="password" name="password" placeholder="Password" required><br>
<input type="submit" name="submit" value="Login" class="submitBtn"><br>
  <p>Don't have an account? <a href="register.php"> Sign Up</a></p>
</form>
</div>
</body>

</html>