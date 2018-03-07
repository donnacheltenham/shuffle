<?php

//set connectoion variables to match DB details
$host = "ChrisRSS.188.121.44.185:3306";
$username = "ChrisRSS";
$password = "Jeof123";
$database = "ChrisRSS";

//connect to database
$dbconnection = mysqli_connect($host, $username, $password, $database);

//check if connected, exit if not
if(!$dbconnection) {
	exit("Database could not be connected.");
}