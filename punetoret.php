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
$sql = "SELECT * FROM users";
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
      width: 1px;
    }
    table {
      width: 500;
      border: 1;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th:nth-child(1), td:nth-child(1) {
      width: 20px; /* Ndërrojeni vlerën e kësaj sipas dëshirës */
    }
    th:nth-child(2), td:nth-child(2) {
        width: 20px; /* Gjerësia e checkbox-it */

      }
      

</style>
</head>
<body>
    <div>
<p><input type="submit" value="Regjistro    " class="link-button" onclick="loadRegister()"> </p>
<p><input type="submit" value="  Fshije    " class="link-button" onclick="deleteSelectedRows1()"></p>
    </div>
<div class="admin-container">
<table >
    <tr>
        <th>Punëtori</th>
        <th>Zgjedh</th>
    </tr>

    <?php
    // Paraqit detyrat në tabelë
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td><input type='checkbox' class='delete-checkbox' data-id='" . $row["ID"] . "'></td>";
            echo "</tr>";
            
        }
    } else {
        echo "<tr><td colspan='4'>Nuk gjendet asnjë punëtorë në databazë.</td></tr>";
    }function loadRegister() {
            loadContent("register.php", ".content");
        }
    ?>
</table>
</div>

</body>
</html>
