<?php
include '../registerNavbar.php';
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = htmlspecialchars(trim($_POST["password"]));
        $email = htmlspecialchars(trim($_POST["email"]));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && $email != 'admin') {
        $_SESSION['errorMsg'] = "Invalid email format";
        header("location: login.php");
        exit;
        }


    // Get user
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE email = ?");
    $stmt->execute([$email]);
    $customer = $stmt->fetch();

    if ($customer && password_verify($password, $customer['password'])) {
        $_SESSION['user_id'] = $customer['CustomerID'];  
        if ($_SESSION['user_id'] == 1) { //add admin id
          header("location:../qindex.php");
            exit;
        }
        // echo "Login successfull";

        header("location:../customerHomePage.php");
        exit;
    } else {
        $error = "Invalid email or password";
    }
}
?>
<div class="formContainer">

    <form method="POST">
        <input type="text" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>



        <input type="submit" name="submit" value="Login" class="submitBtn"><br>
        <p>Don't have an account? <a href="register.php"> Sign Up</a></p>
    </form>
    <?php if (!empty($error)) { ?>
        <p class="errorMsg">
            <?= $error; ?>
        </p>
    <?php } ?>
    
</div>
<p class='info'>admin login: <br>email: admin password: admin <br>
customer login: <br>email: tst@gmail.com password: Qwerty123 <br> </p>
</body>

</html>