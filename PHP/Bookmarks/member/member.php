<?php
	//include function
	session_start();
	require_once('../fns/bookmark_fns.php');
	
	//create short variable name
	$username = $_POST['username'];
	$passwd = $_POST['passwd'];
	
	//echo $username." | ".$passwd."<br>";
	//if($username && $passwd) {
		//attempt login
		try {
			if(login($username, $passwd) == false)
				throw new Exception;
			//Sucessful login
			$_SESSION['valid_user'] = $username;
		}
		catch(exception $e) {
			//Unsucessful login
			do_html_header('Problem');
			echo "You could not be logged in. try again.";
			do_html_URL('login.php', 'Log in');
			do_html_footer();
			exit;
		}
		
	//} else {
	//	//Unsucessful login
	//	do_html_header('Problem');
	//	echo "You could not be logged in.
	//		You must be fill in the box.";
	//	do_html_footer();
	//	exit;
	//}
	
	do_html_header('Home');
	check_valid_user();
	// Get user's bookmarks
	if($url_array = get_user_urls($_SESSION['valid_user'])) {
		display_user_urls($url_array);
	}
	//give menu of optino
	display_user_menu();
	
	do_html_footer();
?>