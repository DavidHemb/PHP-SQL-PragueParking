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
    <div class="menu">
        <h1>
            Prague Parking
        </h1>
        <h2>
            Check in
        </h2>
        <form action="Parkconfirmation.php" method="post">
            <?php if (isset($_GET['error'])) {?><p class="error"><?php echo $_GET['error']; ?></p><?php } ?>
            <label for="reg">RegNr</label><br>
            <input type="text" id="REG" name="reg" value="Ex:abc123"><br>
            <label for="vtype">Vehicletype:</label>
            <input type="radio" id="vtype" name="vtype" value="CAR" required>CAR
            <input type="radio" id="vtype" name="vtype" value="MC">MC
            <h2></h2>
            <input style="background-color: black; color: white;" type="submit" value="Submit">
        </form>
        <form action="index.php">
                <input style="background-color: black; color: white;" type="submit" value="Back">
        </form>
    </div>
</body>
</html>