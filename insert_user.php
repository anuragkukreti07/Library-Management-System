<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database connection details
$servername = "localhost";
$username = "kaeya"; // Replace with your MySQL username
$password = "kaeya"; // Replace with your MySQL password
$database = "login"; // Replace with your database name

// Create a new connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user data from the AJAX request
$name = $_POST['name'];
$email = $_POST['email'];
$google_id = $_POST['google_id'];
$e1 = password_hash($email, PASSWORD_DEFAULT);

// Prepare and execute the SQL query with prepared statements
$sql = "INSERT INTO user_info (full_name, email, google_id,password) VALUES (?, ?, ?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $google_id, $e1);

if ($stmt->execute()) {
    echo "User data inserted successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
