<?php 
require 'SQLFiles.php';
$data = array($_POST['REG']);
$reg = strtoupper($data[0]);
    //Discurage placeholder
    if ($reg == "EX:ABC123")
    {
        header("Location: Search.php?error=Please remove placeholder!");
        exit();
    }
    $status = ToSQL::FindReg($reg);
    if ($status == -1)
    {
        header("Location: Search.php?error=The registration number not found in garage!");
        exit();
    }
    //Search Engine
    // Create connection
    $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT RegNr, ParkingSpotID, VehicleTypeID, ArrivalTime FROM Tickets WHERE RegNr = '{$reg}'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $conn->close();
    if($row['VehicleTypeID'] == 1)
    {
        $type = 'Car';
    }
    else if($row['VehicleTypeID'] == 2)
    {
        $type = 'MC';
    }
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
        <div class="menu">
            <h1>
                Prague Parking
            </h1>
            <h2>
                Search engine
            </h2> 
            <h3>
                Information:
            </h3>
            <p>RegNr: <?php echo $row['RegNr']?><br><br>Type: <?php echo $type?><br><br>Parked in bay: <?php echo $row['ParkingSpotID']?><br><br>Parked: <?php echo $row['ArrivalTime']?></p>
            <form action="index.php">
                <input style="background-color: black; color: white;" type="submit" value="Back">
            </form>
        </div>
    </body>
</html>