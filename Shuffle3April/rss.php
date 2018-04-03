<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	
<?php include("dbconnect.inc.php");
	
if (isset($_GET['genre'])) {
	//Get genre from URL
	$selectedGenre = $_GET['genre'];
	
	//Get all rss items where rss_genre equals the genre from the url (i.e. selected genre)
	$feeds = mysqli_query($dbconnect, "SELECT * FROM rss WHERE rss_genre= '{$selectedGenre}'");
} else {
	//If no genre selected, get all rss items
	$feeds = mysqli_query($dbconnect, "SELECT * FROM rss");
}

?>
</body>
</html>