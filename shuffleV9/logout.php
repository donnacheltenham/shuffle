<?php /*?>This ends the session and re directs to index.php page<?php */

session_start();
session_destroy();
header("location: index.php");

?>
