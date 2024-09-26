<?php
$servername = "localhost"; // Change if necessary
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "kalitec_hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO appointments (name, email, mobile, doctor, date, time, problem) VALUES (?, ?, ?, ?, ?, ?, ?)");
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("sssssss", $name, $email, $mobile, $doctor, $date, $time, $problem);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$doctor = $_POST['doctor'];
$date = $_POST['date'];
$time = $_POST['time'];
$problem = $_POST['problem'];

if ($stmt->execute()) {
    echo "Appointment booked successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
