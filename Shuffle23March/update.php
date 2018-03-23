<?php session_start();?> <?php include( 'dbconnect.inc.php' );
$pageTitle = "|  Update RSS Feed";

if (isset($_GET['id'])) {
	$updateQuery = mysqli_query( $dbconnect,
	"SELECT * FROM `RSS`
    WHERE `rss_id`={$_GET['id']}" );

	while ( $row = mysqli_fetch_array( $updateQuery ) ) {
		$id = $row[ 'rss_id' ];
		$address = $row[ 'address' ];
		$title = $row[ 'title' ];
		$category = $row[ 'category' ];
		$active = $row['active'];
	}
}

?>
<!DOCTYPE HTML>

<html>

<head>
	<meta charset="utf-8">
	<!-- content security for android -->
	<!-- look here: http://stackoverflow.com/questions/30212306/no-content-security-policy-meta-tag-found-error-in-my-phonegap-application -->
	<meta http-equiv="Content-Security-Policy" content="default-src * data: gap: https://ssl.gstatic.com 'unsafe-eval'; style-src 'self' 'unsafe-inline'; media-src *; script-src * 'unsafe-inline' 'unsafe-eval';">
	<title>Shuffle - The Music App</title>
	<link href="mainstyle.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
</head>

<body>

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Main -->
					<div id="main">
						
							<?php
							if ( isset( $_SESSION[ "u_level" ] ) ) {
								if ( $_SESSION[ "u_level" ] == "admin" ) {
									?>
							<form class="form-horizontal" method="post" enctype="multipart/form-data" action="mng_content.php">
								<div class="control-group">
									<label class="control-label">RSS Feed Title</label>
									<div class="controls">
										<input name="title" type="text" placeholder="title" value="<?php echo $title;?>">
									</div>
								</div><br>
								<div class="control-group">
									<label class="control-label">RSS Feed URL</label>
									<div class="controls">
										<input name="address" type="text" placeholder="address" value="<?php echo $address;?>">
									</div>
								</div><br>
								<div class="control-group">
									<label class="control-label">Feed Category</label>
									<div class="controls">
										<select name="category">
											<option value="<?php echo $category; ?>" selected="selected"><? echo $category;?></option>
											<option value="Business">Business</option>
											<option value="Finance">Finance</option>											
											<option value="General">General</option>
											<option value="News">News</option>	
										    <option value="Science">Science</option>  											
											<option value="Sport">Sport</option>								    								    	
									    	<option value="Technology">Technology</option> 
											<option value="Trivia">Trivia</option>
										</select>
									
									</div>
								</div><br>
								<div class="control-group">
									<label class="control-label">RSS Feed Active</label>
									<div class="controls">
										<?php 
											if ($active == 1){
												?>
												<input type="radio" name="active" value="1" checked>Active<br>
  												<input type="radio" name="active" value="0">Not active<br>
											<?php									
											} else {
											?>
												<input type="radio" name="active" value="1">Active<br>
  												<input type="radio" name="active" value="0" checked>Not active<br>
											<?php
											}
										?>
									</div>
								</div>								
								&nbsp; &nbsp;
								<div class="form-actions">
									<button style="color:white; text-decoration:none;" type="submit" class="btn btn-success" value="Update"><a style="color:white;">
										<a style="color:white; text-decoration:none;">Update</a>
									  </button>
								

									<a class="btn" href="admin_feeds.php">Back</a>
								</div>
								<input type="hidden" name="action" value="update"/>
								<input type="hidden" name="id" value="<?php echo $id;?>"/>
							</form>
						
						<p>
							<?php
							if ( $_SESSION[ 'message' ] != "" ) {
								echo $_SESSION[ 'message' ];
								$_SESSION[ 'message' ] = "";
							}
							?>
						</p>
						<?php
						} else {
							?> You do not have adminstrator privileges to view this page.
						<?php
						}
						} else {
							?> You need to log in to view this page.
						<?php
						}
						?>

					</div>
				</section>

			</div>
		</div>

		<!-- Sidebar -->
		<div id="sidebar">
			<div class="inner">

				<!-- Search -->
				<section id="search" class="alt">
					<form method="post" action="#">
						<input type="text" name="query" id="query" placeholder="Search"/>
					</form>
				</section>

				<!-- Menu -->

				<?php	include('nav.inc.php'); ?>

				<!-- Footer -->
				<footer id="footer">
					<p class="copyright">&copy; CPC 2017. All rights reserved.</p>
				</footer>

			</div>
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