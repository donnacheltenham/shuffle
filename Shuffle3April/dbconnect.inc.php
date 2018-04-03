<?php

//set connectoion variables to match DB details
$host = "";
$username = "dccreatesco_shuffle";
$password = "S30109130";
$database = "dccreatesco_shuffle";


//connect to database
$dbconnection = mysqli_connect($host, $username, $password, $database);


//check if connected, exit if not
if(!$dbconnection) {
	exit("Database could not be connected.");
}
