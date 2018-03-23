<!doctype html>
<html>
		<head>
		<meta charset="utf-8">
		<!-- content security for android -->
		<!-- look here: http://stackoverflow.com/questions/30212306/no-content-security-policy-meta-tag-found-error-in-my-phonegap-application -->
		<meta http-equiv="Content-Security-Policy" content="default-src * data: gap: https://ssl.gstatic.com 'unsafe-eval'; style-src 'self' 'unsafe-inline'; media-src *; script-src * 'unsafe-inline' 'unsafe-eval';">
		<title>Shuffle - The Music App</title>
		<link href="mainstyle.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<script>
			$(document).ready(function() {

				 $.support.cors = true;

				$("#register").click(function() {

					username = $("[name='username']").val();
					password = $("[name='password']").val();
					firstname = $("[name='firstname']").val();
					lastname = $("[name='lastname']").val();

					if(username=="") {
						$("#messages").html("Please enter a username.");
						return false;
					}

					if(password=="") {
						$("#messages").html("Please enter a password.");
						return false;
					}

					if(firstname=="") {
						$("#messages").html("Please enter a first name.");
						return false;
					}

					if(lastname=="") {
						$("#messages").html("Please enter a last name.");
						return false;
					}

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
						url: "https://shuffle.twistednetworkmedia.uk/mng_user.php?action=register&r_username=" + username + "&r_password=" + password + "&r_firstname=" + firstname + "&r_lastname=" + lastname,
						success: function(data) {


							responseString="";

							$.each(data, function (index, item) {
							    // Use item in here
							    responseString = item;
							});

							$("#messages").html(responseString);

						},
						error: function (jqXHR, textStatus, errorThrown) {
							if (jqXHR.status == 500) {
				                $("#messages").html('Internal error: ' + jqXHR.responseText);
				            } else {
				                $("#messages").html('Unexpected error.');
				            }
						}
					});



				});

			});
		</script>
		</head>

		<body>

<section id="main">
         <div id="mainlogo"> 
          	<a href="index.php"><img src="images/ShuffleLogo.png" width="100%" height="" alt="" /> </a>
          </div>
          
          <h1>Please enter your details below</h1>
          <form>
    <input type="text" name="username" placeholder="Username">
    <br />
    <input type="password" name="password" placeholder="Password">
    <br />
    <input type="text" name="firstname" placeholder="First Name">
    <br />
    <input type="text" name="lastname" placeholder="Last Name">
    <br />
    <input type="button" value="Register" id="register">
  </form>
          <div id="messages"> </div>
          <p class="login"><a href="login.php">Log In</a></p>
          <div class="homebutton">
          	
          </div>
        </section>
        
	<section id="footer"> <img src="images/SundaeMediaLogo.png" width="100%" height="" alt="" />
          <p>Powered by Sundae Media</p>
        </section>
        
<img src="images/loading.gif" id="loading" />
</body>
</html>