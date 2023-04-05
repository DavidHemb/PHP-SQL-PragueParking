<?php
require('config.php');
class Vehicle
{
   public $spot;
   public $reg;
   public $type;
   public $date;

   public function __construct($spot, $reg, $type, $date)

   {
      $this->spot = $spot;
      $this->reg = $reg;
      $this->type = $type;
      $this->date = $date;
      //$this->spot = pickSpot($type);
      //$this->date = date('Y/m/d H:i');
   }
   public function getSpot()
   {
      return $this->spot;
   }

   public function getReg()
   {
      return $this->reg;
   }
   public function getType()
   {
      return $this->type;
   }

   public function getDate()
   {
      return $this->date;
   }
}
class ToSQL
{

    //BASIC SQL FUCTIONS


    //ToSQL::CreateDatabase($conn);
    static function CreateDatabase($conn)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        // Create database
        $sql = "CREATE DATABASE PragueParkingPHP";
        if ($conn->query($sql) === TRUE) 
        {
            echo "Database created successfully";
        } else 
        {
            echo "Error creating database: " . $conn->error;
        }
        $conn->close();
    }
    //ToSQL::CreateTable($conn);
    static function CreateTable($conn)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        // sql to create table
        $sql = "CREATE TABLE ParkingSpots (
        ParkingSpotID INT NOT NULL PRIMARY KEY,
        OccupationStatus INT
        )";

        if ($conn->query($sql) === TRUE) {
        echo "Table created successfully";
        } else {
        echo "Error creating table: " . $conn->error;
        }

        $conn->close();
    }
    //ToSQL::AlterTable($conn);
    static function AlterTable($conn)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO ParkingSpots (ParkingSpotID, OccupationStatus)
        VALUES ('10', '0')";

        if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    //ToSQL::DeleteDataT($conn);
    static function DeleteDataT()
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        // sql to delete a record
        $sql = "DELETE FROM Tickets";
        if ($conn->query($sql) === TRUE) 
        {
        echo "Record deleted successfully";
        } 
        else 
        {
        echo "Error deleting record: " . $conn->error;
        }
        $conn->close();
    }
    //ToSQL::UpdateData($conn);
    static function UpdateData()
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "UPDATE ParkingSpots SET OccupationStatus= '0' WHERE ParkingSpotID = 1";
        if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }
    }


    //FUNCTIONS


    //Vehicle
    //ToSQL::ViewTableV($conn);
    static function ViewTableV($conn)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT VehicleID, VehicleType, Price FROM Vehicle";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<br>" . "VehicleID: " . $row["VehicleID"]. " - VehicleType: " . $row["VehicleType"]. " - Price: " . $row["Price"];
        }
        } 
        else 
        {
        echo "<br>" . "0 results";
        }
        $conn->close();
    }

    //ParkingSpots
    //ToSQL::ViewTableP($conn);
    static function ViewTableP($intent, $type, $try)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        //intent == 0: Write out values
        if ($intent == 0)
        {
            $sql = "SELECT ParkingSpotID, OccupationStatus FROM ParkingSpots";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) 
            {
                // output data of each row
                while($row = $result->fetch_assoc()) 
                {
                    echo "<br>" . "ParkingSpotID: " . $row["ParkingSpotID"]. "  - OccupationStatus: " . $row["OccupationStatus"];
                }
            }
            else 
            {
                echo "<br>" . "Table empty";
            } 
        }
        //intent == 1: Find first spot
        else if($intent == 1)
        {
            //type == 1: Car
            if ($type == 1 && $try == 1)
            {
                try
                {
                    $query = $conn->prepare("SELECT ParkingSpotID FROM ParkingSpots WHERE OccupationStatus=?");
                    $query->bind_param('i', $OccupationStatus);
                    $OccupationStatus = "0";
                    $query->execute();
                    $result = $query->get_result();
                    $r = $result->fetch_array(MYSQLI_ASSOC);
                    if ($r['ParkingSpotID'] == NULL) 
                    {
                        return 0;
                    }
                    else
                    {
                        return $r['ParkingSpotID'];
                    }
                }
                catch (Exception)
                {

                }
            }
            //type == 2: MC
            if ($type == 2 && $try == 1)
            {
                try
                {
                    $query = $conn->prepare("SELECT ParkingSpotID FROM ParkingSpots WHERE OccupationStatus=?");
                    $query->bind_param('i', $OccupationStatus);
                    $OccupationStatus = "1";
                    $query->execute();
                    $result = $query->get_result();
                    $r = $result->fetch_array(MYSQLI_ASSOC);
                    if ($r['ParkingSpotID'] == NULL) 
                    {
                        return 0;
                    }
                    else
                    {
                        return $r['ParkingSpotID'];
                    }
                }
                catch (Exception)
                {

                }
            }
            //type == 2: MC, 2nd try
            if ($type == 2 && $try == 2)
            {
                try
                {
                    $query = $conn->prepare("SELECT ParkingSpotID FROM ParkingSpots WHERE OccupationStatus=?");
                    $query->bind_param('i', $OccupationStatus);
                    $OccupationStatus = "0";
                    $query->execute();
                    $result = $query->get_result();
                    $r = $result->fetch_array(MYSQLI_ASSOC);
                    if ($r['ParkingSpotID'] == NULL) 
                    {
                        return 0;
                    }
                    else
                    {
                        return $r['ParkingSpotID'];
                    }
                }
                catch (Exception)
                {

                }
            }
        }
        $conn->close();
    }

    //Tickets
    //ToSQL::ViewTableT($conn);
    static function ViewTableT($conn)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT RegNr, ParkingSpotID, VehicleTypeID, ArrivalTime FROM Tickets ORDER BY ParkingSpotID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                echo "<br>" . "RegNr: " . $row["RegNr"] . " - ParkingSpotID: " . $row["ParkingSpotID"] . " - VehicleTypeID: " . $row["VehicleTypeID"] . " - ArrivalTime: " . $row["ArrivalTime"];
            }
        } 
        else 
        {
            echo "<br>" . "No cars in garage!";
        }
            $conn->close();
    }

    //ToSQL::FindReg($reg);
    static function FindReg($reg)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $query = $conn->prepare("SELECT RegNr FROM Tickets WHERE RegNr=?");
        $query->bind_param('s', $reg);
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        try
        {
            if ($r['RegNr'] == NULL)
            {
                return -1;
            }
            if ($r['RegNr'] == $reg) 
            {
                return 1;
            }
            else
            {
                return -1;
            }
        }
        catch(Exception)
        {

        }
    }
    

    //Specilized FUNCTIONS


    //ToSQL::ParkVehicle($reg, $type);
    static function ParkVehicle($reg, $type)
    {
        $trys = 1;
        //Get Spot
        $spot = ToSQL::ViewTableP(1, $type, $trys);
        //Try again MC
        if ($spot == 0 && $type == 2)
        {
            $trys = 2;
            $spot = ToSQL::ViewTableP(1, $type, $trys);
        }
        if ($spot == 0)
        {
            return -1;
        }
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        date_default_timezone_set('Europe/Berlin');
        $date = date('Y-m-d H:i', time());
        //Insert to tickets
        $stmt = $conn->prepare("INSERT INTO Tickets (RegNr, ParkingSpotID, VehicleTypeID, ArrivalTime) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siis", $reg, $spot, $type, $date);
        $stmt->execute();
        $stmt->close();
        //If car
        if($type == 1)
        {
            //Update Parkingspot
            $stmt = $conn->prepare("UPDATE ParkingSpots SET Occupationstatus= ? WHERE ParkingSpotID = ?");
            $stmt->bind_param('ii',$Occupationstatus, $spot); 
            $Occupationstatus = "2";
            $stmt->execute();
            $stmt->close();
        }
        //If MC
        // prepare and bind
        if($type == 2)
        {
            if($trys == 2)
            {
                //Update Parkingspot
                $stmt = $conn->prepare("UPDATE ParkingSpots SET Occupationstatus= ? WHERE ParkingSpotID = ?");
                $stmt->bind_param('ii',$Occupationstatus, $spot); 
                $Occupationstatus = "1";
                $stmt->execute();
                $stmt->close();
            }
            else
            {
                //Update Parkingspot
                $stmt = $conn->prepare("UPDATE ParkingSpots SET Occupationstatus= ? WHERE ParkingSpotID = ?");
                $stmt->bind_param('ii',$Occupationstatus, $spot); 
                $Occupationstatus = "2";
                $stmt->execute();
                $stmt->close();
            }
        }
        return 1;
    }

    //ToSQL::RetriveVehicle($reg);
    static function RetriveVehicle($reg)
    {
        
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //Get type
        $query = $conn->prepare("SELECT VehicleTypeID FROM Tickets WHERE RegNr=?");
        $query->bind_param('s', $reg);
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        if ($r['VehicleTypeID'] != NULL) 
        {
            $type = ($r['VehicleTypeID']);
        }
        else 
        {
            return -1;
        }

        //Get spot
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $query = $conn->prepare("SELECT ParkingSpotID FROM Tickets WHERE RegNr=?");
        $query->bind_param('s', $reg);
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);
        $conn->close();
        if ($r['ParkingSpotID'] != NULL) 
        {
            $spot = ($r['ParkingSpotID']);
        }
        else 
        {
            return -1;
        }

        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //Get occupationstatus IF MC
        if ($type == 2)
        {
            $query = $conn->prepare("SELECT OccupationStatus FROM ParkingSpots WHERE ParkingSpotID=?");
            $query->bind_param('i', $spot);
            $query->execute();
            $result = $query->get_result();
            $r = $result->fetch_array(MYSQLI_ASSOC);
            $conn->close();
            if ($r['OccupationStatus'] != NULL) 
            {
                
                if ($r['OccupationStatus'] == 1)
                {
                    $newOccupationStatus = 0;
                }
                else if ($r['OccupationStatus'] == 2)
                {
                    $newOccupationStatus = 1;
                }
            }
            else
            {
                return -1;
            }
        }
        
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        //Insert to tickets
        //If car
        if($type == 1)
        {
            //Delete vehicle
            $stmt = $conn->prepare("DELETE FROM Tickets WHERE RegNr = ?");
            $stmt->bind_param('s', $reg); 
            $stmt->execute();
            $stmt->close();

            //Update Parkingspot
            $stmt = $conn->prepare("UPDATE ParkingSpots SET Occupationstatus= ? WHERE ParkingSpotID = ?");
            $stmt->bind_param('ii',$newOccupationStatus, $spot); 
            $newOccupationStatus = "0";
            $stmt->execute();
            $stmt->close();
            return 1;
        }
        //If MC
        // prepare and bind
        if($type == 2)
        {
            //Delete vehicle
            $stmt = $conn->prepare("DELETE FROM Tickets WHERE RegNr = ?");
            $stmt->bind_param('s', $reg); 
            $stmt->execute();
            $stmt->close();

            //Update Parkingspot
            $stmt = $conn->prepare("UPDATE ParkingSpots SET Occupationstatus= ? WHERE ParkingSpotID = ?");
            $stmt->bind_param('ii',$newOccupationStatus, $spot); 
            $stmt->execute();
            $stmt->close();
            return 1;
        }
        return -1;
    }
}
?>