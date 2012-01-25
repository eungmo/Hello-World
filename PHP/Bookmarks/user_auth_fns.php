<?php
	require_once('db_fns.php');
	
	function register($username, $email, $password) {
		//register new person
		
		//connect DB
		$conn = db_connect();
		
		//check if username is unique
		$query = "SELECT * FROM user WHERE username='".$username."'";
		echo "query : ".$query."<br>";
		
		$result = mysql_query($query);
		
		if(!$result) {
			throw new Exception("That user is taken - go back and choose another one.");
		}
		
		//if ok, put in DB
		$query = "INSERT INTO user VALUES ('".$username."', sha1('".$password."'), '".$email."')";
		echo "query : ".$query."<br>";
		
		$result = mysql_query($query);
		
		if(!$result) {
			throw new Exception("Could not register you in database - please try again later.");
		}
		
		return true;
	}
	
	function login($username, $password) {
		//login ///////////////////////////////////잘모르겠다------------------------------
		
		//connect DB
		$conn = db_connect();
		
		//check if username is unique
		$query = "SELECT * FROM user WHERE username='".$username."' and passwd = sha1('".$passwd."')";
		echo "query : ".$query."<br>";
		
		$result = mysql_query($query);
		
		if(!$result) {
			throw new Exception("Could not lon in");
		}
	}
	
	function check_valid_user() {
		//check if somebody is lgged in
		if(isset($_SESSION['valid_user'])) {
			//Log in Sucessfully
			echo "Logged in as ".$_SESSION['valid_user'].".<br />";
		} else {
			//not Log in
			do_html_header('Log in Problem');
			echo "You are not logged in<br />";
			do_html_url('login.php', 'Login');
			exit;
		}
	}
	
	function change_password($username, $old_password, $new_password) {
		//Change password
		
		login($username, $old_password);
		
		$conn = db_connect();
		$query = "UPDATE user SET passwd = sha1('".$new_password."') WHERE username = '".$username."'";
		
		$result = mysql_query($query);
		
		if(!$result) {
			throw new Exception("Password could not be changed");
		} else {
			//Changed sucessfully
			return true;
		}
	}
	
	function get_random_word($min_length, $max_length) {
		//get random word
		
		//generate random word
		$word = '';
		// remember to change this path to suit your system
		$fp = @fopen("words.txt", 'r');
		if(!$fp) {
			return false;
		}
		
		//get the next whole word of the right length in the file
		while((strlen($word) < $min_length) || (strlen($word) > $max_length)
			|| (strstr($word, "'"))) {
			
			if(feof($fp)) {
				fseek($fp, 0);	//if end, go to start
			}	
			$word = fget($fp, 80);
			$word = fget($fp, 80);
		}
		$word = trim($word);
		return $word;
	}
	
	function reset_password($username) {
		//set random password
		$new_password = get_random_word(6, 13);
		
		if($new_password == false) {
			throw new Exception("Could not generate new password.");
		}
		
		//add a number 0~999
		$rand_number = rand(0, 999);
		$new_password = $new_password + $rand_number;
		
		//set password
		$conn = db_connect();
		$query = "UPDATE user SET passwd = sha1('".$new_password."')
			WHERE username = '".$username."'";
		$result = mysql_query($query);
		if(!$result) {
			throw new Exception("Could not change password");
		} else {
			return $new_password;
		}
	}
	
	function notify_password($username, $password) {
		//notify password
		$conn = db_connect();
		$query = "SELECT email FROM user WHERE username = '".$username."'";
		$result = mysql_query($query);
		
		if(!$result) {
			throw new Exception("Could not find email address");
		} else {
			$row = $result->fetch_object();
			$email = $row->email;
			$from = "From: suppoert@phpbookmark \r\n";
			$mesg = "Your PHPBookmark password has been changed to ".$password."\r\n
				Please change it next time you log in. \r\n";
			
			if(mail($email, 'PHPBookmark login information', $msg, $from)) {
				return true;
			} else {
				throw new Exception("Could not send email");
			}
		}
	}
?>


























































