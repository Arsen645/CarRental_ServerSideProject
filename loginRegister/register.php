


    <?php
    include '../registerNavbar.php';
    
    $id = 0;

    $name;
        $password;
        $email;
        $phone;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['customerName'];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $phone= $_POST["phone"];
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Insert into DB
        $stmt = $pdo->prepare("INSERT INTO customers (CorporateName, Email, Phone, password) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$name, $email, $phone, $hashedPassword]);
            $_SESSION['cust_message'] = 'Registered successfully';
            header("location:../customerHomePage.php");
            exit;
    exit;
        } catch (PDOException $e) {
            echo "Error " . $e;
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
    ?>
    <div class="formContainer">
        <form method="POST">
            <input type="text" name="customerName" placeholder="Name" required><br>
            <input type="password" name="password" placeholder="Password" required><br>

            <input type="text" name="email" placeholder="Email" required><br>
            <input type="text" name="phone" placeholder="Phone" required><br>


            <input type="submit" name="submit" value="Register" class="submitBtn"><br>
            <p>Have an account? <a href="login.php"> Log In</a></p>
        </form>
    </div>
</body>

</html>