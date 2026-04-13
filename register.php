<?php include 'connection.php';

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
        $password = $_POST["password"];
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Insert into DB
        $stmt = $pdo->prepare("INSERT INTO users (name, password) VALUES (?, ?)");
        try {
            $stmt->execute([$name, $hashedPassword]);
            echo "User registered successfully!";
        } catch (PDOException $e) {
            echo "Error: Email may already be in use.";
        }
    }
    ?>
    <div class="formContainer">
        <form method="POST">
            <input type="text" name="customerName" placeholder="Name" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="submit" value="Register" class="submitBtn"><br>
            <p>Have an account? <a href="login.php"> Log In</a></p>
        </form>
    </div>
</body>

</html>