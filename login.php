<?php
// Enable Error Reporting to Debug Issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Connection
$host = "localhost";  
$username = "uojzqiuqn2pam";  // Aap apna database username yahan likhein  
$password = "jjx7ajrkuyhy";   // Aap apna database password yahan likhein  
$dbname = "dbksoo6hfjorlc";   // Aap apna database name yahan likhein  

$conn = new mysqli($host, $username, $password, $dbname);

// Check Database Connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

session_start();
$error = ""; // Variable for storing errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Check if Fields are Empty
    if (empty($username) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Check if Users Table Exists
        $tableCheckQuery = "SHOW TABLES LIKE 'users'";
        $result = $conn->query($tableCheckQuery);
        if ($result->num_rows == 0) {
            die("Error: Users table does not exist in the database.");
        }

        // Fetch User from Database
        $query = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Error in Query: " . $conn->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $username, $hashedPassword);
            $stmt->fetch();
            if (password_verify($password, $hashedPassword)) {
                $_SESSION["user_id"] = $id;
                $_SESSION["username"] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Incorrect password. Try again.";
            }
        } else {
            $error = "Username not found. Please sign up.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            width: 40%;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 24px;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            width: 95%;
            padding: 12px;
            background: #007bff;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #0056b3;
        }
        p {
            margin-top: 10px;
            font-size: 14px;
        }
        a {
            color: blue;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login to Your Account</h2>
    
    <!-- Display Error Messages -->
    <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>

    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Enter Username" required><br>
        <input type="password" name="password" placeholder="Enter Password" required><br>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="signup.php">Sign Up Here</a></p>
</div>

</body>
</html>
