<?php
// Lidhuni me bazën e të dhënave MySQL
$servername = "localhost";
$username = "root"; // ndërro këtë me emrin e përdoruesit të bazës së të dhënave
$password = ""; // ndërro këtë me fjalëkalimin e bazës së të dhënave
$dbname = "perdoruesit";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo lidhjen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Merrni ID e rreshtave të zgjedhur nga kërkesa GET
if (isset($_GET['id'])) {
    $selectedRows = $_GET['id'];

    // Përdorni explode për të ndarë ID-të
    $ids = explode(',', $selectedRows);

    // Për çdo ID, fshijeni nga tabela
    foreach ($ids as $id) {
        $sql = "DELETE FROM users WHERE ID = $id";
        $conn->query($sql);
    }
}

$conn->close();
?>
