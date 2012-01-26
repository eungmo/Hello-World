<?php
	session_start();
	require_once("bookmark_fns.php");
	
	do_html_header("Changing password");
	$old_passwd = $_POST['old_passwd'];
	$new_passwd = $_POST['new_passwd'];
	$new_passwd2 = $_POST['new_passwd2'];
	
	try {
		check_valid_user();
		if(!filled_out($_POST)) {
			throw new Exception("You have not filled out the form completely. Please try again.");
		}
		
		if($new_passwd != $new_passwd2) {
			throw new Exception("Passwords entered were not same. Not changed.");
		}
		
		if((strlen($new_passwd) > 16) || (strlen($new_passwd) < 6)) {
			throw new Exception("New password must be between 6 and 16 characters. Try again.");			
		}
		
		//attempt update
		change_password($_SESSION['valid_user'], $old_password, $new_password);
		echo "Password changed";
	} catch(exception $e) {
		echo $e->getMessage();
	}
	display_user_menu();
	do_html_footer();
?>



