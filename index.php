<?php
include 'db.php';

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1><u>My Blog</u></h1>
    <a href="create.php">Create New Post</a>
    <div class="posts">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<h2>" . $row['title'] . "</h2>";
                echo "<p>" . $row['content'] . "</p>";
                echo "<small>Posted on " . $row['created_at'] . "</small>";
                echo "<a href='edit.php?id=" . $row['id'] . "'>Edit</a> | ";
                echo "<a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No posts found</p>";
        }
        ?>
    </div>
</body>
</html>
