<?php
function getDatabaseConnection()
{
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "b5fd7e721a6e84";
    $password = "4acba240";
    $dbname = "heroku_3a83060270e607d"; 
    
     $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
     $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
     return $dbConn;
    /*
    $host = "localhost";
    $username = "thengboz";
    $password = "cst336";
    $dbname="tech_devices_app";

// Create connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    return $conn;
    */
  }

?>