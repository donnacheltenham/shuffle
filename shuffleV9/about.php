<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<!-- content security for android -->
	<!-- look here: http://stackoverflow.com/questions/30212306/no-content-security-policy-meta-tag-found-error-in-my-phonegap-application -->
	<meta http-equiv="Content-Security-Policy" content="default-src * data: gap: https://ssl.gstatic.com 'unsafe-eval'; style-src 'self' 'unsafe-inline'; media-src *; script-src * 'unsafe-inline' 'unsafe-eval';">
	<title>Shuffle - The Music App</title>
	<link href="mainstyle.css" rel="stylesheet" type="text/css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
</head>

<body>
	<h2>About</h2>
	<div class="features">
		<article>
			<div class="content">
				<h3>Browse Music RSS feeds by Genre</h3>
				<p>Find the best music related RSS feeds and then subscribe, then view them any time from your personalised page.</p>
			</div>
		</article>
		<article>
			<div class="content">
				<h3>Your Views</h3>
				<p>Review and rate our feeds</p>
			</div>
		</article>
	</div>
	App developed by <a href="http://www.joshsoer.com/">Josh Soer</a>, <a href="https://twistednetworkmedia.uk/">Donna Cheltenham</a>, Ben Pope, Hollie O'Reilly and Sam Ashworth
	<main>
		<footer> <img src="images/SundaeMediaLogo.png" width="100%" height="" alt=""/>
			<p>Powered by Sundae Media</p>
		</footer>
	</main>
</body>
</html>