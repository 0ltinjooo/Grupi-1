<?php
// Example login credentials
$adminUsername = "admin";
$adminPassword = "admin123";

$puntoriUsername = "puntori";
$puntoriPassword = "puntori123";

// Retrieve user input from the form
$userInputUsername = $_POST['username'];
$userInputPassword = $_POST['password'];

// Check login credentials and redirect accordingly
if ($userInputUsername === $adminUsername && $userInputPassword === $adminPassword) {
    header("Location: admin.html");
    exit();
} elseif ($userInputUsername === $puntoriUsername && $userInputPassword === $puntoriPassword) {
    header("Location: puntori.html");
    exit();
} else {
    // Invalid credentials, redirect back to the login page
    header("Location: login.html");
    exit();
}
?>
