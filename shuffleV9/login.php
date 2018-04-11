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

            $("#login").click(function() {

                username = $("[name='username']").val();
                password = $("[name='password']").val();

                if (username == "") {
                    $("#messages").html("Please enter a username.");
                    return false;
                }

                if (password == "") {
                    $("#messages").html("Please enter a password.");
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
                    url: "mng_user.php?action=login&l_username=" + username + "&l_password=" + password,
                    success: function(data) {


                        responseString = "";

                        $.each(data, function(index, item) {
                            // Use item in here
                            responseString = item;
                        });

                        if (responseString.indexOf("LOGGEDIN") > -1) {

                            //get rest of data after prefix (LOGGEDIN:)
                            //the number is the character position to start from, we cut off the prefix
                            userid = responseString.substring(9);

                            location.href = "home.php";

                        }
                        if (responseString.indexOf("NOTFOUND") > -1) {

                            //get rest of data after prefix (NOTFOUND:)
                            //the number is the character position to start from, we cut off the prefix
                            message = responseString.substring(9);

                            $("#messages").html(message);

                        }
                        if (responseString.indexOf("INVALID") > -1) {

                            //get rest of data after prefix (INVALID:)
                            //the number is the character position to start from, we cut off the prefix
                            message = responseString.substring(8);

                            $("#messages").html(message);

                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status == 500) {
                            $("#messages").html('Internal error: ' + jqXHR.responseText);
                        } else {
                            $("#messages").html('Unexpected error.' + jqXHR.status + ' ' + textStatus + ' ' + errorThrown);
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
            <input type="button" value="Log In" id="login">
        </form>
        <div id="messages"> </div>
        <div id="notmember">
            <p>Not a member?</p>
        </div>

        <p id="signup"><a href="register.php">Sign up</a></p>
    </section>

    <section id="footer">
        <img src="images/SundaeMediaLogo.png" width="100%" height="" alt="Logo" />
        <p>Powered by Sundae Media</p>
    </section>
    <img src="images/loading.gif" id="loading" alt="loading" />
</body>

</html>