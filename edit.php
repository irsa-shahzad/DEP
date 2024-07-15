<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE id=$id";
    $result = $conn->query($sql);
    $post = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>" required>
        <label for="content">Content</label>
        <textarea id="content" name="content" required><?php echo $post['content']; ?></textarea>
        <button type="submit">Update Post</button>
    </form>
</body>
</html>
