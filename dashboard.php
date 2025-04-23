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

// ✅ Check If User is Logged In
session_start();
if (!isset($_SESSION['user_id'])) {
    die("<script>alert('❌ Please Login First!'); window.location.href='login.php';</script>");
}

// ✅ Blog Add Karne Ka Form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Add Blog</title>

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
        h2 {
            color: #007bff;
            margin-bottom: 15px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .logout {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            background: red;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .logout:hover {
            background: darkred;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Add a New Blog</h2>
        <form action="add_blog.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Enter Blog Title" required>
            <textarea name="content" rows="5" placeholder="Enter Blog Content" required></textarea>
            <input type="file" name="image">
            <button type="submit">Add Blog</button>
        </form>
        <a href="logout.php" class="logout">Logout</a>
    </div>

</body>
</html>
