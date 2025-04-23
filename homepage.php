<?php
include 'db.php';

$sql = "SELECT id, title, content FROM blogs ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blogger</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .blog-post { border: 1px solid #ddd; padding: 10px; margin: 10px 0; }
        .read-more { display: inline-block; margin-top: 5px; padding: 5px 10px; background: blue; color: white; text-decoration: none; }
    </style>
</head>
<body>

<h2>All Blogs</h2>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='blog-post'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        
        // Show only first 100 characters
        echo "<p>" . substr(htmlspecialchars($row['content']), 0, 100) . "...</p>";
        
        // Read More Button
        echo "<a href='blog.php?id=" . $row['id'] . "' class='read-more'>Read More</a>";
        
        echo "</div>";
    }
} else {
    echo "<p>No blogs available.</p>";
}
?>

</body>
</html>
