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
            Search engine
        </h2>
        <form action="Searchconfirmation.php" method="post">
        <?php if (isset($_GET['error'])) {?><p class="error"><?php echo $_GET['error']; ?></p><?php } ?>
            <label for="REG">RegNr</label><br>
            <p></p>
            <input type="text" id="REG" name="REG" value="Ex:abc123"><br>
            <input style="background-color: black; color: white;" type="submit" value="Submit">
        </form>
        <form action="index.php">
            <input style="background-color: black; color: white;" type="submit" value="Back">
        </form>
    </div>
</body>
</html>