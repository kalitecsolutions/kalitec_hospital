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
$pass = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
$email = $_POST['email'];

// Insert the user into the database
$sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Registration successful!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
