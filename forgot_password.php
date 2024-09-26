<?php
// forgot_password.php

$servername = "localhost";
$username = "root"; // Adjust based on your setup
$password = ""; // Adjust based on your setup
$dbname = "kalitec_hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Prepare statement to check if both username and email exist and match
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ? AND email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $password = $row['password'];

        // Return the password in JSON format
        echo json_encode([
            'success' => true,
            'password' => $password
        ]);
    } else {
        // Return a message if the username or email doesn't match
        echo json_encode([
            'success' => false,
            'message' => 'Username or email not found.'
        ]);
    }

    $stmt->close();
}

$conn->close();
?>
