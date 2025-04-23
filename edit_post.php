<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE blogs SET title='$title', content='$content' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM blogs WHERE id=$id");
$row = $result->fetch_assoc();
?>
<form action="edit_post.php" method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <input type="text" name="title" value="<?= $row['title'] ?>">
    <textarea name="content"><?= $row['content'] ?></textarea>
    <button type="submit">Update</button>
</form>
