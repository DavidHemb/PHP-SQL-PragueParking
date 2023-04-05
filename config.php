<?php
const DB_HOST = 'localhost';
const DB_NAME = 'PragueParkingPHP';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
function connect($dbHost, $dbName, $dbUsername, $dbPassword)
{
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if($conn->connect_error)
    {
        die("Cannot connect to database: \n" . $conn->connect_error . "\n" . $conn->connect_errno);
    }
    return $conn;
}