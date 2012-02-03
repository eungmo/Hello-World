<?php
	require_once("../fns/bookmark_fns.php");
	
	do_html_header("Resetting password");
	
	//creating short variable name
	$username = $_POST['username'];
		
	try {
		$password = reset_password($username);
		echo "New password: ".$password."<br><br>";				////////////////////////////////////
		//notify_password($username, $password);			////////////////////////////////////
		echo "Your new password has been been emailed to you.<br />";
	} catch(exception $e) {
		echo "Your password could not be reset - please try again later.";
	}
	do_html_url('login.php', 'Login');
	
	do_html_footer();
?>