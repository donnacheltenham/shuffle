<?php

//set connectoion variables to match DB details
$host = "";
$username = "networkme_shuffle";
$password = "shuffle123!";
$database = "networkme_shuffle";


//connect to database
$dbconnection = mysqli_connect($host, $username, $password, $database);


//check if connected, exit if not
if(!$dbconnection) {
	exit("Database could not be connected.");
}
