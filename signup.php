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

// Signup Logic
$error = ""; // Variable for storing errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Check if Fields are Empty
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Check if Users Table Exists
        $tableCheckQuery = "SHOW TABLES LIKE 'users'";
        $result = $conn->query($tableCheckQuery);
        if ($result->num_rows == 0) {
            die("Error: Users table does not exist in the database.");
        }

        // Check if Username Already Exists
        $checkQuery = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($checkQuery);
        if (!$stmt) {
            die("Error in Query: " . $conn->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already taken. Try another one.";
        } else {
            // Insert User
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            if (!$stmt) {
                die("Error in Query: " . $conn->error);
            }
            $stmt->bind_param("sss", $username, $email, $hashedPassword);
            if ($stmt->execute()) {
                header("Location: login.php?signup=success");
                exit();
            } else {
                $error = "Signup failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
        .signup-container {
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
            background: #28a745;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #218838;
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

<div class="signup-container">
    <h2>Create an Account</h2>
    
    <!-- Display Error Messages -->
    <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>

    <form action="signup.php" method="post">
        <input type="text" name="username" placeholder="Enter Username" required><br>
        <input type="email" name="email" placeholder="Enter Email" required><br>
        <input type="password" name="password" placeholder="Enter Password" required><br>
        <button type="submit">Sign Up</button>
    </form>

    <p>Already have an account? <a href="login.php">Login Here</a></p>
</div>

</body>
</html>
