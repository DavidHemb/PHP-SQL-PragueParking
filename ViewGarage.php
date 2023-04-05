<?php
    require 'SQLFiles.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylemenu.css">
    <title>Park</title>
</head>
<body>
    <div class="menuView">
        <h1>
            Prague Parking
        </h1>
        <p style="text-align: center;"><?php ToSQL::ViewTableP(0, 0, 0); ?></p>
        <p><?php ToSQL::ViewTableT(1); ?></p>
        <form action="index.php">
                <input style="background-color: black; color: white;" type="submit" value="Back">
        </form>
    </div>
</body>
</html>