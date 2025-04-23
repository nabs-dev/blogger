<?php
// ✅ Error Reporting Enable Karo
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

// ✅ Blog ID Fetch from URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $blog_id = $_GET['id'];

    // ✅ Fetch Blog from Database
    $query = "SELECT * FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $blog = $result->fetch_assoc();
    } else {
        die("<script>alert('❌ Blog Not Found!'); window.location.href='index.php';</script>");
    }
} else {
    die("<script>alert('❌ Invalid Blog ID!'); window.location.href='index.php';</script>");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($blog['title']); ?> - My Blogger</title>

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
            padding: 20px;
        }
        .container {
            width: 60%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        .blog-title {
            font-size: 26px;
            color: #007bff;
            margin-bottom: 15px;
        }
        .blog-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .blog-content {
            font-size: 18px;
            color: #333;
            text-align: left;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="blog-title"><?php echo htmlspecialchars($blog['title']); ?></h1>
        
        <?php if (!empty($blog["image"])): ?>
            <img src="<?php echo htmlspecialchars($blog["image"]); ?>" class="blog-image" alt="Blog Image">
        <?php endif; ?>

        <p class="blog-content"><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>
        
        <a href="index.php" class="back-btn">🔙 Back to Home</a>
    </div>

</body>
</html>
