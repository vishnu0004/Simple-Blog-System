<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Blog Post</title>
    <link rel="stylesheet" href="../css/create.css">
</head>
<body>
    <div class="form-container">
        <h1>Edit Blog Post</h1>
        <?php
            include('../config.php');

            // Fetch the post to be edited
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM posts WHERE id = '$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $dtitle = $row['title'];
                    $dcontent = $row['content'];
                } else {
                    echo "No post found with the given ID!";
                    exit;
                }
            } else {
                echo "Invalid request, post ID is missing!";
                exit;
            }

            // Handle form submission for updating the post
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $content = $_POST['content'];

                $edit = "UPDATE posts SET title='$title', content='$content' WHERE id='$id'";
                $run = $conn->query($edit);
                if ($run) {
                    header("Location: index.php");
                } else {
                    echo "Failed to update the post!";
                }
            }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">

            <!-- Title Input -->
            <div class="input-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($dtitle); ?>" placeholder="Enter the title" required>
            </div>

            <!-- Content Input -->
            <div class="input-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" placeholder="Enter the content" rows="6" required><?= htmlspecialchars($dcontent); ?></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn" name="submit">Update</button>
        </form>
    </div>
</body>
</html>
