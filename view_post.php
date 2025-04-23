<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM blogs WHERE id=$id");
$row = $result->fetch_assoc();
?>
<h1><?= $row['title'] ?></h1>
<p>By <?= $row['author'] ?></p>
<img src="<?= $row['image'] ?>" width="300">
<p><?= $row['content'] ?></p>
<a href="index.php">Back</a>
