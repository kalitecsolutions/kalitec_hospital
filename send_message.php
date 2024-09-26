<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "kalitec_hospital");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set
    if (isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $subject = $conn->real_escape_string($_POST['subject']);
        $message = $conn->real_escape_string($_POST['message']);

        // Prepare SQL statement
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

        // Execute query and check for success
        if ($conn->query($sql) === TRUE) {
            echo "Message sent successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
}

// Close connection
$conn->close();
?>
