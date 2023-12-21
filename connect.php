<?php
// Establish a MySQL connection (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$database = "puntoret";

$conn = new mysqli($servername, $username, $password, $database);


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri = $_POST["emri"];
    $password = $_POST["password"];
    
    // Assuming you have a database connection established here
    
    // Insert new user into the database
    $emri = $_POST["emri"];
    // ...
    $sql = "INSERT INTO users (emri, password) VALUES ('$emri', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        // Registration successful
        echo '<script>alert("User registered successfully!");</script>';
        echo '<script>window.location.href = "puntoret.html";</script>';
        exit();
    } else {
        // Registration failed
        echo '<script>alert("Error occurred during registration. Please try again.");</script>';
        echo '<script>window.location.href = "puntoret.html";</script>';
        exit();
    }
}

// Close the database connection
$conn->close();
?>
