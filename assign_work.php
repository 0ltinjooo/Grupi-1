<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <form action="assign_work.php" method="post">
            <label for="workTitle">Titulli i punës:</label>
            <input type="text" id="workTitle" name="workTitle" required><br><br>
            <label for="workDescription" style="display: block; margin-bottom: 5px;">Përshkrimi i punës:</label>
<textarea id="workDescription" name="workDescription" rows="8" style="width: 100%; resize: vertical;" required></textarea><br><br>

            <label for="assignedUser">Cakto Tek:</label>
        <select id="assignedUser" name="assignedUser">

            <?php
            // Database credentials for your existing database
            $servername = "localhost"; // Usually "localhost" if the database is on the same server
            $username = "root";
            $password = "";
            $dbname = "perdoruesit";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare SQL query to fetch users from your database table (assuming your table name is "users")
            $sql = "SELECT  username FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row as dropdown options
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["username"] . "'>" . $row["username"] . "</option>";
                }
            } else {
                echo "<option value=''>No users found</option>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </select><br><br>
      
            <input type="submit" value="Cakto Punën">
           
        </form>
</body>
</html><?php
session_start();

// Check if the user is logged in as admin
if ($_SESSION["username"] !== "admin") {
    header("Location: index.html"); // Redirect to login page if not admin
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workTitle = $_POST["workTitle"];
    $workDescription = $_POST["workDescription"];
    $assignedUser = $_POST["assignedUser"]; // Assuming you have a form field for selecting the user

    // Database credentials for your existing database
    $servername = "localhost"; // Usually "localhost" if the database is on the same server
    $username = "root";
    $password = "";
    $dbname = "perdoruesit";
       // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare SQL query to insert work details and assigned user into your existing database table
    $sql = "INSERT INTO work (title, description, assigned_user, data) VALUES ('$workTitle', '$workDescription', '$assignedUser',NOW())";

    if ($conn->query($sql) === TRUE) {
        // Work details inserted successfully, no need to redirect
        echo "Work assigned successfully!";
        header("Location: admin.php");
        } else {
        // Error occurred while inserting data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

