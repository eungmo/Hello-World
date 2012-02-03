<?php
	session_start();
	require_once("../fns/bookmark_fns.php");
	
	do_html_header("Recommending URLs");
	
	try {
		check_valid_user();
		$urls = recommend_urls($_SESSION['valid_user']);
		display_recommended_urls($urls);

	} catch(exception $e) {
		echo $e->getMessage();		
	}
	display_user_menu();
	do_html_footer();
?>