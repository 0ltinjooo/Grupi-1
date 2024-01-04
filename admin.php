<?php
session_start();

// Kontrollo nëse përdoruesi është kyçur dhe është admin
if (!isset($_SESSION["username"]) || $_SESSION["username"] !== "admin") {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #333;
            color: #fff;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar li {
            padding: 15px;
            text-align: center;
        }

        .sidebar li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: 0.3s;
        }

        .sidebar li a:hover {
            background-color: #555;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #222;
            display: flex; /* Përdorimi i flexbox për të ndarë faqen në dy kolona */
        }

        /* Stilet shtesë për përmbajtjen */
        .content h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .content p {
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            background-color: #333;
            border: none;
            border-radius: 5px;
            color: #ffffff;
        }

        input[type="submit"] {
            width: calc(100% - 20px);
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            padding: 15px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 20px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .logout-button {
            background-color: #4caf50;
            color: #ffffff;
            border: 1px;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin: 30px 0 0 0;
            display: inline-block;
        }

        .logout-button:hover {
            background-color: #45a049;
        }
    </style>

    <script>
        function loadContent(url, targetElement) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.querySelector(targetElement).innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function loadAssignWork() {
            loadContent("assign_work.php", ".content");
        }

        function loadRegister() {
            loadContent("register.php", ".content");
        }

        function Works() {
            loadContent("user.php", ".content");
        }

        // Ngarko faqen user.php automatikisht në fillim
        window.onload = function () {
            Works();
        };
        function loadContent(url, targetElement) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.querySelector(targetElement).innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function loadAssignWork() {
            loadContent("assign_work.php", ".content");
        }

        function loadRegister() {
            loadContent("register.php", ".content");
        }

        function Works() {
            loadContent("user.php", ".content");
        }
        function Workers() {
            loadContent("punetoret.php", ".content");
        }


  function deleteSelectedRows() {
    var checkboxes = document.getElementsByClassName("delete-checkbox");
    var selectedRows = [];

    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        selectedRows.push(checkboxes[i].getAttribute("data-id"));
      }
    }

    // Dërgo kërkesën GET në skriptën PHP për të fshirë rreshtat
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "delete.php?id=" + selectedRows.join(','), true);
    xhr.send();

    // Rifresko faqen pas fshirjes
    Works();
  }

  function deleteSelectedRows1() {
    var checkboxes = document.getElementsByClassName("delete-checkbox");
    var selectedRows = [];

    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        selectedRows.push(checkboxes[i].getAttribute("data-id"));
      }
    }

    // Dërgo kërkesën GET në skriptën PHP për të fshirë rreshtat
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "delete1.php?id=" + selectedRows.join(','), true);
    xhr.send();

    // Rifresko faqen pas fshirjes
    Workers();
  }
    </script>
</head>

<body>
    <div class="sidebar">
        <h2>Paneli adminit</h2>
        <ul>
            <li><a href="javascript:void(0);" onclick="Works()">Punët</a></li>
            <li><a href="javascript:void(0);" onclick="Workers()">Punëtorët</a></li>
            
            <li><a href="logout.php">Dil</a></li>
        </ul>
    </div>
    <div class="content">
    </div>
</body>

</html>
