<?php
session_start();

// Database credentials
$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "perdoruesit";

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get task ID from the request
$taskId = $_GET['id'];

// Update task status in the database
$updateSql = "UPDATE work SET status = 'completed' WHERE ID = $taskId";
if ($conn->query($updateSql) === TRUE) {
    echo "Task completed successfully.";
} else {
    echo "Error updating task: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
