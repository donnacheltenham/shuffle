<?php
    // Disable the displaying of none-important errors

    error_reporting(E_ALL ^ E_NOTICE);

    // Creates the full URL of the current location

    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    // Changes the connection array depending on the hosting being local or public

    $array = (strpos($url, 'localhost') !== false ? ['localhost', 'root', '', 'shuffle'] : ['10.169.0.169', 'joshsoer_shuffle', 'shuffle1', 'joshsoer_shuffle']);

    // Complete the connection to the database
    $dbconnect = mysqli_connect(...$array);
?>