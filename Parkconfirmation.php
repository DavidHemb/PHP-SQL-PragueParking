<?php
require 'SQLFiles.php';
$reg = strtoupper($_POST['reg']);
$type = ($_POST['vtype']);
//Convert type and keep string version
if ($type == 'CAR')
{
    $typeINT = 1;
}
else if ($type == 'MC')
{
    $typeINT = 2;
}
$status = 0;
$findreg = ToSQL::FindReg($reg);
//Discurage placeholder
if ($reg == "EX:ABC123")
{
    header("Location: Park.php?error=Please remove placeholder!");
    exit();
} 
else if($findreg == 1)
{
    header("Location: Park.php?error=RegNr already in garage!");
    exit();
}
//Send vehicle to prossesing
else
{
    $status = ToSQL::ParkVehicle($reg, $typeINT);
}
//If garage is full
if ($status == -1)
{
    header("Location: Park.php?error=Garage is full!");
    exit();
}
else if ($status == 0)
{
    header("Location: Park.php?error=Error!");
    exit();
}
date_default_timezone_set('Europe/Berlin');
$date = date('Y-m-d H:i', time());
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
                Park engine
            </h2> 
            <h3>
                Information:
            </h3>
            <p>RegNr: <?php echo $reg?><br><br>Type: <?php echo $type?><br><br>Parked: <?php echo $date?></p>
            <form action="index.php">
                <input style="background-color: black; color: white;" type="submit" value="Back">
            </form>
        </div>
    </body>
</html>