<?php
	function db_connect() {
		$host = 'localhost';
		$user = 'root';
		$password = 'apmsetup';
		$dbname = 'bookmarks';
		$db = mysql_connect($host, $user, $password);
		if(!$db) {
			die("立加角菩 : ".mysql_error());
		} //else {
		//	echo "DB 立加 己傍<br />";
		//}
		
		$db_selected = mysql_select_db($dbname, $db);
		if(!$db_selected) {
			die("Can\'t use dbname : ".mysql_error());
		}// else {
		//	echo "DB 急琶 己傍<br />";
		//}
	}
?>