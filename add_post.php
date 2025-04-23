<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    
    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $image = "uploads/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }
    
    $sql = "INSERT INTO blogs (title, author, content, image) VALUES ('$title', '$author', '$content', '$image')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
