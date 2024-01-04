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

// Prepare SQL query to fetch assigned work for the user (assuming the user is identified by their session or user ID)
$username = $_SESSION["username"]; // Change this to the appropriate session or user ID variable
$status = isset($_GET['status']) ? $_GET['status'] : 'all';

if ($status === 'all') {
    $sql = "SELECT * FROM work WHERE assigned_user = '$username'";
} else {
    $sql = "SELECT * FROM work WHERE assigned_user = '$username' AND status = '$status'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listë e Punëve</title>
    <style>
        table {
      width: 100%;
      table-layout: auto; /* Kjo pjesë e kodit e bën tabelën të zgjerohet varësisht nga përmbajtja e tekstit */
      border-collapse: collapse;
      margin-bottom: 20px; /* Për arsye demonstrative, mund ta ndryshoni këtë vlerë sipas nevojës */
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th:nth-child(1), td:nth-child(1) {
      width: 50px; /* Ndërrojeni vlerën e kësaj sipas dëshirës */
    }
    th:nth-child(2), td:nth-child(2) {
      width: 100px; /* Ndërrojeni vlerën e kësaj sipas dëshirës */
    }
    th:nth-child(3), td:nth-child(3) {
      width: 55; /* Ndërrojeni vlerën e kësaj sipas dëshirës */
    }
    th:nth-child(4), td:nth-child(4) {
        width: 20px; /* Gjerësia e checkbox-it */
      }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Titulli i punës</th>
            <th>Koha e caktimit të punës</th>
            <th>Përshkrimi i punës</th>
            <th>Zgjedh</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["data"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td><button onclick='completeTask(" . $row["ID"] . ")'>Plotëso</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nuk u gjet asnjë punë e caktuar.</td></tr>";
            
        }
        ?>
    </table>
    <script>
function completeTask(taskId) {
    // You can use AJAX to send a request to the server to mark the task as completed
    // For simplicity, let's assume you have a separate PHP file to handle the completion logic (complete_task.php)

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response if needed
            alert(xhr.responseText);
        }
    };
    xhr.open("GET", "complete_task.php?id=" + taskId, true);
    xhr.send();
}
</script>
    <br>
    <a href="logout.php">Dil</a>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
