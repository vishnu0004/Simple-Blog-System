<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post Form</title>
    <link rel="stylesheet" href="../css/create.css">
</head>
<body>
    <div class="form-container">
        <h1>Create a New Blog Post</h1>
        <?php
            include('../config.php');
            if(isset($_POST['submit'])){
                $title = $_POST['title'];
                $content = $_POST['content'];

                $sql = "insert into blogt (title,content)values('$title','$content')";
                $result = $conn->query($sql);
                if($result){
                    header("location: index.php");
                }
                else{
                    echo "not inserted data into database!";
                }
            }
        ?>
        <form method="post">
            <!-- Title Input -->
            <div class="input-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" placeholder="Enter the title" required>
            </div>

            <!-- Content Input -->
            <div class="input-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" placeholder="Enter the content" rows="6" required></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
