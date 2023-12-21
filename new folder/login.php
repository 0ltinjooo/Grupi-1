<!-- login.php -->
<?php
// Kontrollo nese eshte shtypur butoni submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Marrja e vlerave nga forma
    $emri = $_POST["emri"];
    $password = $_POST["password"];

    // Kontrollimi i përdoruesit dhe fjalëkalimit (përmendni që kjo është një shembull i thjeshtë)
    if ($emri == "admin" && $password == "admin") {
        // Përdoruesi është i saktë, dërgoje në panelin e administratorit
        header("Location: admin.html");
        exit();
    } else {
        // Përdoruesi ose fjalëkalimi i gabuar, mund të shtoni mesazh për gabim
        echo "Përdoruesi ose fjalëkalimi i gabuar.";
    }
}
?>
