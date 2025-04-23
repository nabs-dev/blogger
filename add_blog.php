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

// ✅ Form Submit Check
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // ✅ Image Upload Check
    if (!empty($_FILES["image"]["name"])) {
        $image_name = basename($_FILES["image"]["name"]);
        $target_dir = "uploads/";
        $target_file = $target_dir . $image_name;
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            $image_path = NULL;
        }
    } else {
        $image_path = NULL;
    }

    // ✅ Blog Insert Query
    $query = "INSERT INTO blogs (title, content, image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $title, $content, $image_path);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Blog Successfully Added!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('❌ Error Adding Blog: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
