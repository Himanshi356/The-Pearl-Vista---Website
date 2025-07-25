<?php
$servername = "localhost";
$username = "root"; // default for XAMPP
$password = "";     // default for XAMPP
$dbname = "pearlvista";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// Prepare and bind (make sure your 'contacts' table has columns: name, email, phone, subject, message)
$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

if ($stmt->execute()) {
    echo "Thank you for contacting us!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>