<?php

define("dbhost", "localhost");

define("dbsuername", "root");

define("dbpass", "");
define("dbname", "testdb");

$conn = new mysqli(dbhost, dbsuername, dbpass, dbname);

if($conn){
    // echo "connected";

}else{
    die("Connection failed". $conn->connect_error);
}
