<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="admin-container">
<form action="register.php" method="post">
            <label for="newUsername">Punëtori i Ri:</label>
            <input type="text" id="newUsername" name="newUsername" required><br><br>
            <label for="newPassword">Fjalëkalimi i Ri:</label>
            <input type="password" id="newPassword" name="newPassword" required><br><br>
            <input type="submit" value="Regjistro">
        </form>
</body>
</html>
<?php
// Establish a MySQL connection (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$database = "perdoruesit";

$conn = new mysqli($servername, $username, $password, $database);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["newUsername"];
    $newPassword = $_POST["newPassword"];
    
    // Check if the username already exists
    $checkQuery = "SELECT * FROM users WHERE username = '$newUsername'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Username already exists, display an error message
        echo '<script>alert("Ky punëtor tani më ekziston.");</script>';
        echo '<script>window.location.href = "admin1.php";</script>';
        exit();
    } else {
        // Username does not exist, proceed with registration
        $sql = "INSERT INTO users (username, password) VALUES ('$newUsername', '$newPassword')";
        
        if ($conn->query($sql) === TRUE) {
            // Registration successful
            echo '<script>alert("Punëtori u regjistrua me sukses!");</script>';
            echo '<script>window.location.href = "admin1.php";</script>';
            exit();
        } else {
            // Registration failed
            echo '<script>alert("Error occurred during registration. Please try again.");</script>';
            echo '<script>window.location.href = "admin1.php";</script>';
            exit();
        }
    }
}

// Close the database connection
$conn->close();
?>
