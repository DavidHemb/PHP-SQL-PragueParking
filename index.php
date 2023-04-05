<?php
require 'SQLFiles.php';
//ToSQL::DeleteDataT();
//ToSQL::UpdateData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylemenu.css">
    <title>Menu</title>
</head>
<body>
    <div class="menu">
        <h1>
            Prague Parking
        </h1>
        <nav>
            <ul style="list-style-type: none">
                <li><a href="Park.php">Park vehicle</a></li>
                <li><a href="Retrive.php">Retrieve vehicle</a></li>
                <li><a href="Search.php">Search vehicle</a></li>
                <li><a href="ViewGarage.php">View garage</a></li>
            </ul>
        </nav>
        <p style="text-align: center; text-decoration: underline; justify-content: flex-start;">
        <?php 
            $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
            if ($conn instanceof mysqli)
            {
                echo "Client info: " .$conn->client_info . "\n" . "Client Version: " . $conn->client_version;
            }
            $conn->close();
        ?>
    </p>
    </div>
</body>
</html>