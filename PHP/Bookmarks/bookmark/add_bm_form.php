<?php
	//include function files for this application
	session_start();
	require_once("../fns/bookmark_fns.php");
	
	//start output html
	do_html_header("Add Bookmarks");
	
	check_valid_user();
	display_add_bm_form();
	
	display_user_menu();
	do_html_footer();
	
?>