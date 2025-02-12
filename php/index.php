<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
<?php
include('../config.php');

$sql = "SELECT * FROM blogt ORDER BY create_at DESC";
$result = $conn->query($sql);

echo '<div class="blog-container">'; // Start the blog container
    ?>
        <a href="create.php"><button class="submit-btn" name="submit">Add Blogs</button></a>
    <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="blog-post">'; // Start each blog post
        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
        echo "<a href='edit.php?id=" . $row['id'] . "'>Edit</a> | ";
        echo "<a href='delete.php?id=" . $row['id'] . "'>Delete</a>";
        echo "</div>"; // End each blog post
    }
} else {
    echo "<div class='no-posts'>No posts found.</div>";
}

echo '</div>'; // End the blog container

$conn->close();
?>

</body>
</html>