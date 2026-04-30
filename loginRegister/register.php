    <?php
    include '../registerNavbar.php';
    //htmlspecialchars(trim(
    $_SESSION['errorMsg'] = "";
    function isValidPhone ($phone) {
        $pattern = '/^\+?\d{10}$/';
        $result = preg_match($pattern, $phone);
        return $result;
    }
    function isValidPassword ($password) {
        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password))
        return false;
        return true;
    }
    $id = 0;
    $msg = '';
    $name;
        $password;
        $email;
        $phone;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars(trim($_POST['customerName']));
        $password = htmlspecialchars(trim($_POST["password"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $phone= htmlspecialchars(trim($_POST["phone"]));
        
        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // $_SESSION['errorMsg'] = "Invalid email format";
        
        // } else

        // if (!isValidPhone($phone)) {
        //     $_SESSION["errorMsg"] = "Invalid phone number";
        // } else
        // if (!isValidPassword($password)) {
        //     $_SESSION["errorMsg"] = "Password must be at least 8 symbols, contain at least one uppercase letter, one lowercase, and one number";
        // } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Insert into DB
        $stmt = $pdo->prepare("INSERT INTO customers (CorporateName, Email, Phone, password) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$name, $email, $phone, $hashedPassword]);
            $_SESSION['cust_message'] = 'Registered successfully';
            header("location:../customerHomePage.php");
            exit;
    
        } catch (PDOException $e) {
            $_SESSION['errorMsg'] = "Dublicate email";
        }

        $stmt = $pdo->prepare("SELECT CustomerID FROM customers WHERE email = :cemail");

        try {
            $stmt->bindValue(':cemail', $email);
            $stmt->execute();

            if($stmt->rowCount()>0) {
                $row = $stmt->fetch((PDO::FETCH_ASSOC));
                $id = $row['CustomerID'];
                $_SESSION['user_id'] = $id;
                
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }   
        }


    // }
    ?>
    <div class="formContainer">
        <form method="POST">
            <input type="text" name="customerName" placeholder="Name" required><br>
            <input type="password" name="password" placeholder="Password" required><br>

            <input type="text" name="email" placeholder="Email" required><br>
            <input type="text" name="phone" placeholder="Phone" required><br>


            <input type="submit" name="submit" value="Register" class="submitBtn"><br>
            <p>Have an account? <a href="login.php"> Log In</a></p>
            <p><?php echo $_SESSION['errorMsg']; ?></p>
        </form>
    </div>
</body>

</html>