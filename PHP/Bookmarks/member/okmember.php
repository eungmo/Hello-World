<?php
	//include function
	session_start();
	require_once('../fns/bookmark_fns.php');
	
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