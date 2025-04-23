<?php
// ✅ Error Reporting Enable
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ Database Connection
$host = "localhost";
$username = "uojzqiuqn2pam";
$password = "jjx7ajrkuyhy";
$dbname = "dbksoo6hfjorlc";

$conn = new mysqli($host, $username, $password, $dbname);

// ✅ Check Connection
if ($conn->connect_error) {
    die("❌ Database Connection Failed: " . $conn->connect_error);
}

// ✅ Fetch All Blogs
$query = "SELECT * FROM blogs ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blogger - Home</title>

    <style>
        /* ✅ Professional Internal CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .header {
            background: #007bff;
            color: white;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .blog-container {
            background: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        .blog-title {
            font-size: 22px;
            color: #007bff;
            margin-bottom: 10px;
        }
        .blog-content {
            font-size: 16px;
            color: #333;
        }
        .blog-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .read-more {
            background: #007bff;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            display: inline-block;
            margin-top: 10px;
        }
        .read-more:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="header">My Blogger - Home</div>

    <div class="container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="blog-container">
                <?php if (!empty($row["image"])): ?>
                    <img src="<?php echo htmlspecialchars($row["image"]); ?>" class="blog-image" alt="Blog Image">
                <?php endif; ?>
                <h2 class="blog-title"><?php echo htmlspecialchars($row["title"]); ?></h2>
                <p class="blog-content"><?php echo substr(htmlspecialchars($row["content"]), 0, 150) . "..."; ?></p>
                <a href="view_blog.php?id=<?php echo $row['id']; ?>" class="read-more">Read More</a>
            </div>
        <?php endwhile; ?>
    </div>

</body>
</html>
