<!doctype html>
<html>
		<head>
		<!-- content security for android -->
		<!-- look here: http://stackoverflow.com/questions/30212306/no-content-security-policy-meta-tag-found-error-in-my-phonegap-application -->
		<meta http-equiv="Content-Security-Policy" content="default-src * data: gap: https://ssl.gstatic.com 'unsafe-eval'; style-src 'self' 'unsafe-inline'; media-src *; script-src * 'unsafe-inline' 'unsafe-eval';">
		<meta charset="utf-8">
		<title>Shuffle - The music App - Subscriptions</title>
		<link href="mainstyle.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<script type="text/javascript">

		var userid = 0;

		$(document).ready(function() {
			userid = getUrlParameter("userid");

			selectSubscriptions();
			
			$(document).on("click", '.sublink', function(event) { 
    			//alert($(this).attr("rssid"));
				
    			rssid = $(this).attr("rssid");
    			action = $(this).attr("action");

    			$.ajax({
					beforeSend: function() {
						$("#loading").show();
					},
					complete: function() {
						$("#loading").hide();
					},
					type: 'GET',
					dataType: "jsonp",
					jsonp: "callback",
					url: "https://shuffle.twistednetworkmedia.uk/mng_subscription.php?action=" + action + "&user_id=" + userid + "&rss_id=" + rssid,
					success: function(data) {

						responseString="";

						$.each(data, function (index, item) {
						    // Use item in here
						    responseString = item;
						});

						if(responseString.indexOf("SUCCESS")>-1) {

								//get rest of data after prefix (LOGGEDIN:)
								//the number is the character position to start from, we cut off the prefix
								$("#messages").html(responseString.substring(8));

								selectSubscriptions();

							}
						if(responseString.indexOf("FAIL")>-1) {

							//get rest of data after prefix (NOTFOUND:)
							//the number is the character position to start from, we cut off the prefix
							$("#messages").html(responseString.substring(5));

						}

					},
					error: function (jqXHR, textStatus, errorThrown) {
						if (jqXHR.status == 500) {
			                $("#messages").html('Internal error: ' + jqXHR.responseText);
			            } else {
			                $("#messages").html('Unexpected error.');
			            }
					}
				});

				return false;
			});

			$(document).on("click", '.rsslink', function(event) { 
    			location.href="comments.html?userid=" + userid + "&rssid=" + $(this).attr("rssid");
    			return false;
    		});

		});

		function selectSubscriptions() {

			$("#subcontent").html("");

			$.ajax({
				beforeSend: function() {
					$("#loading").show();
				},
				complete: function() {
					$("#loading").hide();
				},
				type: 'GET',
				dataType: "jsonp",
				jsonp: "callback",
				url: "https://shuffle.twistednetworkmedia.uk/mng_subscription.php?action=select&user_id=" + userid,
				success: function(data) {

					responseString="";

					$.each(data, function (index, item) {
					    // Use item in here
					    responseString = item;
					});

					$("#subcontent").html(responseString);

				},
				error: function (jqXHR, textStatus, errorThrown) {
					if (jqXHR.status == 500) {
		                $("#messages").html('Internal error: ' + jqXHR.responseText);
		            } else {
		                $("#messages").html('Unexpected error.');
		            }
				}
			});



		}

		</script>
		</head>

		<body>
			<header> RSS Feed - Subscriptions </header>
<main>
          <div id="messages"> </div>
          <div id="subcontent"> </div>
        </main>
<footer> <a href="index.php">Log Out</a> <img src="images/SundaeMediaLogo.png" width="100%" height="" alt="" />
          <p>Powered by Sundae Media</p>
        </footer>
<img src="images/loading.gif" id="loading" alt="Loading" />
</body>
</html>