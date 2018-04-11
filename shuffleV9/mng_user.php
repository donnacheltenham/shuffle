<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include ("dbconnect.inc.php");

	$action = $_GET['action'];
	$callback = $_GET['callback'];
	$response = '';

	echo $callback . "(";

	if($action == 'register') {
		if($_GET['r_username'] != "" && $_GET['r_password'] != "" && $_GET['r_password_rep'] != "" && $_GET['r_firstname'] != "" && $_GET['r_lastname'] != "") {
			if($_GET['r_password'] == $_GET['r_password_rep']) {
				$md5_password = md5($_GET['r_password']);
				$query = mysqli_query($dbconnect, "INSERT INTO `user` (`username`, `password`, `first_name`, `last_name`) VALUES ('{$_GET['r_username']}', '{$md5_password}', '{$_GET['r_firstname']}', '{$_GET['r_lastname']}')");
			
				if($query) {
					$response = 'ACCOUNT_CREATED';
				}
			}
			else {
				$response = 'PASSWORD_NO_MATCH';
			}
		}
		else {
			$response = 'EMPTY_FIELDS';
		}
	}
	else {
		$md5_password = md5($_GET['l_password']);
        $user_get = mysqli_query($dbconnect, "SELECT * FROM `user` WHERE `username`='{$_GET['l_username']}' AND `password`='{$md5_password}'");
        $i = 0;
        
        // If the credentials are correct, log the user in
        
        if(mysqli_num_rows($user_get) >= 1) {
            
            // Creates a string array to save space
            
            $variables = ['user_id', 'first_name', 'last_name', 'username'];
            $response = 'LOGGED_IN';
            
            while($user_array = mysqli_fetch_array($user_get)) {
                $_SESSION[$variables[$i]] = $user_array[$variables[$i]];
                $i++;
            }
        }
        else {
            $response = 'BAD_CREDENTIALS';
        }
	}

	$array = array( "response" => $response);

	echo json_encode($array);
	echo ")";
?>