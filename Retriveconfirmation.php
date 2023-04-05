<?php
require 'SQLFiles.php';
date_default_timezone_set('Europe/Berlin');
$date = date('Y-m-d H:i', time());
$reg = strtoupper($_POST['REG']);
$findreg = ToSQL::FindReg($reg);
$found = 0;
//Discurage placeholder
if ($reg == "EX:ABC123")
{
    header("Location: Retrive.php?error=Please remove placeholder!");
    exit();
} 
else if($findreg == -1)
{
    header("Location: Retrive.php?error=RegNr not in garage!");
    exit();
}
else
{
    //Get Vehicle Info
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
    //Get Price && type in string
    // Create connection
    $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Check connection
     if ($conn->connect_error) 
     {
         die("Connection failed: " . $conn->connect_error);
     }
     
    $query = "SELECT Price FROM Vehicle WHERE VehicleID = '{$row['VehicleTypeID']}'";
    $result = mysqli_query($conn, $query);
    $Price = mysqli_fetch_assoc($result);
    $conn->close();
    if($row['VehicleTypeID'] == 1)
    {
        $type = 'Car';
    }
    else if($row['VehicleTypeID'] == 2)
    {
        $type = 'MC';
    }
    //Checkout
    $found = ToSQL::RetriveVehicle($reg);
}
if ($found == 1)
{
    $foundS = 'Checked out!';
}   
else
{
    $foundS = 'Error whit checkout!';
}
//Time in hours
$difference = strtotime($date) - strtotime($row['ArrivalTime']);
$difference_in_minutes = $difference / 60;
$difference_in_hours = $difference_in_minutes / 60;
//Min 1h
if($difference_in_hours < 1)
{
    $difference_in_hours = 1;
}
//Fattar inte hur man gör $Price array med en int till en int så man kan gångra...
if($row['VehicleTypeID'] == 1)
{
    $PriceINT = 100;
}
else if($row['VehicleTypeID'] == 2)
{
    $PriceINT = 50;
}
//Final Price calc
$TotalPay = $difference_in_hours * $PriceINT;
round($TotalPay);
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
                Retrieve engine
            </h2> 
            <h3>
                Information:
            </h3>
            <p>
                RegNr: <?php echo $row['RegNr']?><br><br>
                Type: <?php echo $type?><br><br>
                Parked in bay: <?php echo $row['ParkingSpotID']?><br><br>
                Status: <?php echo $foundS?><br><br>
                Parked in garage: <?php echo $row['ArrivalTime']?><br><br>
                Retrieved from garage: <?php echo $date?><br><br>
                Price: <?php echo $Price['Price']?> Kr/H (Min 1H)<br><br>
                Money owed: <?php echo $TotalPay?> Kr
            </p>
            <form action="index.php">
                <input style="background-color: black; color: white;" type="submit" value="Process payment">
            </form>
        </div>
    </body>
</html>