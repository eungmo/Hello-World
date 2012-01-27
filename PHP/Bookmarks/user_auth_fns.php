<?php
	require_once ('db_fns.php');
	
	function register($username, $email, $password) {
		//register new person
	
		//connect DB
		$conn = db_connect();
	
		//check if username is unique
		$query = "SELECT * FROM user WHERE username='" . $username . "'";
		//echo "query : " . $query . "<br>";
	
		$result = mysql_query($query);
	
		if (!$result) {
			throw new Exception("That user is taken - go back and choose another one.");
		}
	
		//if ok, put in DB
		$query = "INSERT INTO user VALUES ('" . $username . "', sha1('" . $password . "'), '" . $email . "')";
		//echo "query : " . $query . "<br>";
	
		$result = mysql_query($query);
	
		if (!$result) {
			throw new Exception("Could not register you in database - please try again later.");
		}
	
		return true;
	}
	
	function login($username, $password) {
		//login 

		//connect DB
		$conn = db_connect();

		//check if username is unique
		$query = "SELECT * FROM user WHERE username='".$username."' and passwd = sha1('".$password."')";		
			
		$result = mysql_query($query);
		
		if (!$result) {
			throw new Exception("Could not lon in");
		}
		
		$row = mysql_fetch_array($result);
			
		$RealPasswd = $row["passwd"];
		
		$password2 = sha1($password);
		if($RealPasswd == $password2) {				
			return true;
		}	
		return false;
	}
	
	function check_valid_user() {
		//check if somebody is lgged in
		if (isset($_SESSION['valid_user'])) {
			//Log in Sucessfully
			echo "Logged in as " . $_SESSION['valid_user'] . ".<br />";
		} else {
			//not Log in
			do_html_header('Log in Problem');
			echo "You are not logged in<br />";
			do_html_url('login.php', 'Login');
			exit ;
		}
	}

	function change_password($username, $old_password, $new_password) {
		//Change password
			
		login($username, $old_password);

		$conn = db_connect();
		$query = "UPDATE user SET passwd = sha1('".$new_password."') WHERE username = '".$username."'";
	
		$result = mysql_query($query);
	
		if (!$result) {
			throw new Exception("Password could not be changed");
		} else {
			//Changed sucessfully
			return true;
		}
	}
	
	function get_random_word() {
		$size = mt_rand(6, 16);
		//echo $size . "<br><br>";
		$newstring = "";
	
		while (strlen($newstring) < $size) {
			switch( mt_rand(1,2) ) {
				case 1 :
					$newstring .= chr(mt_rand(49, 57));
					break;
				// 0-9
				case 2 :
					$newstring .= chr(mt_rand(97, 122));
					break;
				// a-z
				//case 3 :
				//	$newstring .= chr(mt_rand(65, 90));
				//	break;
				// A-Z
			}
		}
		return $newstring;
	}
	
	function reset_password($username) {
		//set random password
		$new_password = get_random_word();
		
		if ($new_password == false) {
			throw new Exception("Could not generate new password.");
		}
	
		//set password
		$conn = db_connect();
		$query = "UPDATE user SET passwd = sha1('" . $new_password . "')
			WHERE username = '" . $username . "'";
		$result = mysql_query($query);
		if (!$result) {
			throw new Exception("Could not change password");
		} else {
			return $new_password;
		}
	}
	
	function notify_password($username, $password) {
		//notify password
		$conn = db_connect();
		$query = "SELECT email FROM user WHERE username = '" . $username . "'";
		$result = mysql_query($query);
	
		if (!$result) {
			throw new Exception("Could not find email address");
		} else {
			$row = mysql_fetch_object($result);		/////////////////////////////////////////////
			$email = $row -> email;
			$from = "From: suppoert@phpbookmark \r\n";
			$msg = "Your PHPBookmark password has been changed to " . $password . "\r\n
	Please change it next time you log in. \r\n";
	
			if (mail($email, 'PHPBookmark login information', $msg, $from)) {
				return true;
			} else {
				throw new Exception("Could not send email");
			}
		}
	}
?>

