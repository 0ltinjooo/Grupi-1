<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "perdoruesit";

$conn = new mysqli($servername, $username, $password, $database);
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    // Check if the credentials are correct for admin
    if ($username == "admin" && $password == "admin") {
        $_SESSION["username"] = $username;
        header("Location: admin.php");
        exit();
    }  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // If a matching record is found, redirect to user.html
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $row['username'];
        header(header: "Location: get_assigned_work.php");
        exit();
    } else {
        // Invalid credentials, redirect back to the login page
        header("Location: index.html");
        exit();
    }

    // Close the database connection
    
}
?>
