<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Shuffle - The Music App</title>
</head>

<link href="mainstyle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<body onload="openInteraction(event, 'Feed')">
	
<?php 

	include("dbconnect.inc.php");
	
	if (isset($_GET['genre'])) {
		//Get genre from URL
		$selectedGenre = $_GET['genre'];

		//Get all rss items where rss_genre equals the genre from the url (i.e. selected genre)
		$feeds = mysqli_query($dbconnect, "SELECT * FROM `rss` WHERE `genre` = '{$selectedGenre}'");
	} 
	else {
		//If no genre selected, get all rss items
		$feeds = mysqli_query($dbconnect, "SELECT * FROM `rss`");
	}
?>

<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

<div id="genreheader">
  <h1><?= strtoupper($selectedGenre) ?></h1>
</div>

<div class="tab">
  <button class="tablinks" onclick="openInteraction(event, 'Feed')"><i class="fas fa-rss"></i> Feed</button>
  <button class="tablinks" onclick="openInteraction(event, 'Comments')"><i class="fas fa-comments"></i>  Comments</button>
</div>

<div id="Feed" class="tabcontent">
	<?php
		while($row = mysqli_fetch_array($feeds)) {
			echo <<<HTML
				<img src="{$row['image_url']}">
				<h2><a href="{$row['link']}">{$row['title']}</a></h2>
				<p>{$row['description']}</p>
HTML;
		}
	?>
</div>

<div id="Comments" class="tabcontent">
  <h3>Insert Comments Here</h3>
 
</div>

<script>
	function openInteraction(evt, interactionName) {
   			var i, tabcontent, tablinks;
		    
		    tabcontent = document.getElementsByClassName("tabcontent");
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = "none";
		    }
		    tablinks = document.getElementsByClassName("tablinks");
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(" active", "");
		    }
		    document.getElementById(interactionName).style.display = "block";
		    evt.currentTarget.className += " active";
		}
</script>

<style>
	body {
		background: unset;
		background-color: white !important;
	}
</style>
</body>
</html>