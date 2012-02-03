<?php
	session_start();
	require_once("../fns/bookmark_fns.php");
	
	do_html_header("Change password");
	check_valid_user();
	
	display_password_form();
	
	display_user_menu();
	do_html_footer();
?>