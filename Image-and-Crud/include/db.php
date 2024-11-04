<?php

define("DBSERVER", "localhost");

define("DBUSERNAME", "root");

define("DBPASSWORD", "");

define( "DBNAME", "testdb");

$conn = new mysqli(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if($conn){
    // echo "connected";
}else{
    $conn->connect_error;
}

