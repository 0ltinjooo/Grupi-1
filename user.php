<?php
// Lidhja me bazën e të dhënave MySQL
$servername = "localhost";
$username = "root"; // ndërro këtë me emrin e përdoruesit të bazës së të dhënave
$password = ""; // ndërro këtë me fjalëkalimin e bazës së të dhënave
$dbname = "perdoruesit";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo lidhjen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kërko të dhënat nga tabela tasks
$sql = "SELECT * FROM work";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Tasks</title>
    <style>
        .link-button {
      background: none;
      border: none;
      color: blue; /* Ngjyra e hiperlinkut */
      cursor: pointer;
      font-size: inherit;
       /* Zgjidhni një gjërësi të përshtatshme */
      height: 60px; /* Zgjidhni një lartësi të përshtatshme */
      width: 100px;
    }

    .completed-task {
      color: green; /* Ngjyra e tekstit për punën e kryer */
    }

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
    th:nth-child(4), td:nth-child(4) {
      width: 150px; /* Ndërrojeni vlerën e kësaj sipas dëshirës */
    }
    th:nth-child(5), td:nth-child(5) {
        width: 20px; /* Gjerësia e checkbox-it */
    }
</style>
</head>
<body>
    <div>
        <p><input type="submit" value="Cakto punën    " class="link-button" onclick="loadAssignWork()"> </p>
        <p><input type="submit" value="Fshije punën   " class="link-button" onclick="deleteSelectedRows()"></p>
    </div>
    <div class="admin-container">
        <table border="1">
            <tr>
                <th>Punëtori</th>
                <th>Titulli i Punës</th>
                <th>Përshkrimi i Punës</th>
                <th>Koha</th>
                <th>Zgjedh</th>
                <th>Puna u krye</th>
            </tr>

            <?php
            // Paraqit detyrat në tabelë
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["assigned_user"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["data"] . "</td>";
                    echo "<td><input type='checkbox' class='delete-checkbox' data-id='" . $row["ID"] . "'></td>";
                    echo "<td><input type='checkbox' class='checkbox' data-id='" . $row["ID"] . "'" . ($row["status"] == 'completed' ? 'checked' : '') . "></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nuk u gjet asnjë punë e caktuar.</td></tr>";
            }
            ?>
        </table>
    </div>
    <script>
        function loadAssignWork() {
            // Implement your logic to load assigned work
        }

        function deleteSelectedRows() {
            // Implement your logic to delete selected rows
        }
    </script>
</body>
</html>
