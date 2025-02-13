<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
    <div class="signup-container">
        <h2>Signup</h2>
        <?php
        include('../config.php');
        if(isset($_POST['signup'])){
            $upload = "../upload/";
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $image_name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $img_path = $upload.$image_name;

            // Check if email already exists
            $check = "SELECT email FROM user WHERE email = '$email'";
            $result = $conn->query($check);

            if(mysqli_num_rows($result) == 0) {  // If email is NOT found, insert new record
                $sql = "INSERT INTO user (name,email,password,image) VALUES('$name','$email','$password','$img_path')";
                $result = $conn->query($sql);

                if($result) {  // Correct check for insert query
                    if(move_uploaded_file($tmp_name, $img_path)){  // Fix parameter order
                        echo "Signup successful, redirecting...";
                        header("Refresh:2; url=login.php"); // Correct syntax
                        exit();
                    } else {
                        echo "Image upload failed.";
                    }
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Email already registered!";
            }
        }
        ?>
        <form action="#" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="file" name="image" accept="image/*" required>
            <button type="submit" name="signup">Sign Up</button>
        </form>
    </div>
</body>
</html>
