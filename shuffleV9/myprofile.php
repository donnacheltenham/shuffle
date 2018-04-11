<?php session_start(); //call or creates session??> <?php include( 'dbconnect.inc.php' );
$pageTitle = "|  My Profile";

?>
<!DOCTYPE HTML>

<html>

<head>
	<title>Shuffle - The Music App</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/css/main.css"/>
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>
		function confirmChoice( userId ) {
			response = confirm( "Are you sure you want to delete your account?" );
			if ( response == 1 ) {
				window.location = "mng_user.php?action=delete";
			} else {
				return false
			}
		}
	</script>

</head>

<body>

	<!-- Wrapper -->
	<div id="wrapper">

				
					<div id="main">
							<?php
							if ( isset( $_SESSION[ "user_id" ] ) ) {
									?>
							<div>
								<?php
								$user_id = $_SESSION['user_id'];
								$userResult = mysqli_query( $dbconnect,
									"SELECT * FROM `USER` WHERE user_id = $user_id" );
								while ( $userRow = mysqli_fetch_array( $userResult ) ) {
								
									echo '<p>Username:<br>' . $userRow[ 'username' ] . '</p>';
									echo '<p>First Name:<br>'.$userRow['first_name']. '</p>';
									echo '<p>Surname:<br>' .$userRow['last_name']. '</p>';

									echo '<div">';
									echo '<a " class="btn btn-success" href="userupdate.php">Update</a>';
									echo '<a " class="btn btn-danger" href="javascript:confirmChoice(' .$user_id . ')">Delete</a>';
									echo '</div>';
								}
								?>
							</div>
							<p>
							<?php
								if(isset($_SESSION['message'])) {
									if($_SESSION['message'] != "") {
										echo $_SESSION['message'];
										$_SESSION['message']= "";
									}
								}
								?>
							</p>
							<?php
							} else {
								?> You need to log in to view this page.<br><br>
								<?php
								if(isset($_SESSION['message'])) {
									if($_SESSION['message'] != "") {
										echo $_SESSION['message'];
										$_SESSION['message'] = "";
									}
								}
							}
							?>
					</div>

	</div>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
	<script src="assets/js/main.js"></script>

</body>

</html>