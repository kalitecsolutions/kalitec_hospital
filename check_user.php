<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kalitec_hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data from AJAX
$user = $_POST['username'];
$pass = $_POST['password'];

// Check if the user exists
$sql = "SELECT * FROM users WHERE username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Check password
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
        echo json_encode(['status' => 'success', 'message' => 'Sign in successful']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}

$conn->close();
?>
