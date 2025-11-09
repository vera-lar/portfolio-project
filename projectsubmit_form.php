<?php
session_start();
include 'db_connection.php'; // Your DB connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Logged-in username
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Prepare SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO messages (username, name, email, phone, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $name, $email, $phone, $message);

    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
