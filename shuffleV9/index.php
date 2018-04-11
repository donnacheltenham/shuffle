<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <!-- content security for android -->
    <!-- look here: http://stackoverflow.com/questions/30212306/no-content-security-policy-meta-tag-found-error-in-my-phonegap-application -->
    <meta http-equiv="Content-Security-Policy" content="default-src * data: gap: https://ssl.gstatic.com 'unsafe-eval'; style-src 'self' 'unsafe-inline'; media-src *; script-src * 'unsafe-inline' 'unsafe-eval';">
    <title>Shuffle - The Music App</title>
    <link href="assets/mainstyle.css" rel="stylesheet" type="text/css" />
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
                    url: "/mng_user.php?action=login&l_username=" + username + "&l_password=" + password,
                    success: function(data) {
                        responseString = "";

                        $.each(data, function(index, item) {
                            // Use item in here
                            responseString = item;
                        });

                        switch(responseString) {
                            case "BAD_CREDENTIALS":
                                alert('Wrong username or password');
                            break;

                            case "LOGGED_IN":
                                window.location = "home.php";
                            break;
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
        <div id="loader">
            <img src="images/shufflepreloaderwhite.gif" width="100%" height="" alt="Loading image" />
        </div>

        <div id="mainlogo">
            <img src="images/ShuffleLogo.png" width="100%" height="" alt="Logo image" />
        </div>

        <form>
            <input class="logintext" type="text" name="username" placeholder="Username">
            <br/>
            <input class="logintext" type="password" name="password" placeholder="Password">
            <br/>
            <input type="button" value="Log In" id="login">
        </form>
        <a href="password.php">Forgotten your password?</a>

        <div id="messages"> </div>

        <div id="notmember">
            <p>Not a member?</p>
        </div>

        <div id="signup">
            <a href="register.php">Sign up</a>
        </div>

        <?	include('footer.inc.php'); ?>




            <script>
                $(window).load(function() {
                    $("#loader").delay(4000);
                    $("#loader").fadeOut(200);

                })
            </script>

</body>

</html>