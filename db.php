<?php
$host = "localhost";
$user = "uojzqiuqn2pam";
$password = "jjx7ajrkuyhy";
$dbname = "dbksoo6hfjorlc";

$conn = new mysqli($host, $user, $password, $dbname);

// Agar connection fail ho jaye toh error dikhaye
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
