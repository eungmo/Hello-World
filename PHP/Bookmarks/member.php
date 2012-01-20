<?php
	//include function
	require_once('bookmark_fns.php');
	session_start();
	
	//create short variable name
	$username = $_POST['username'];
	$passwd = $_POST['passwd'];
	
	if($username && $passwd) {
		//attempt login
		try {
			//login($username, $passwd);		//·Î±×ÀÎ////////////////////////////////////////
			//Sucessful login
			//$_SESSION['valid_user'] = $username;
		}
		catch(Exception $e) {
			//Unsucessful login
			do_html_header('Problem');
			echo "You could not be logged in.
				You must be logged in to view this page.";
			do_html_footer();
			exit;
		}
	}
	
	do_html_header('Home');
	//	check_valid_user();	/////////////////////////////////////////////
	// Get user's bookmarks
	if($url_array = get_user_urls($_SESSION['valid_user'])) {
		display_user_urls($url_array);
	}
	
	///////////////////////////////////////////////////////////////////////////////////////
		


