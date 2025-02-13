<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php
            session_start();
            include('../config.php');
            if(isset($_POST['login'])){
                $email = $_POST['email'];
                $password = md5($_POST['password']);

                $sql = "select * from user where email = '$email' and password = '$password'";
                $result = $conn->query($sql);
                if(mysqli_num_rows($result) > 0){
                    $_SESSION['user'] = $email; // Store session data
                    echo "login successful, redirecting...";
                        header("Refresh:2; url=index.php"); // Correct syntax
                        exit();
                }
                else{
                    echo "invalid email or password";
                }
            }
        ?>
        <form action="#" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.html">Sign Up</a></p>
    </div>
</body>
</html>
