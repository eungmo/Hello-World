<?php
	require_once('db_fns.php');
	
	function get_user_urls($username) {
		
		$conn = db_connect();
		$query = "SELECT bm_URL FROM bookmark WHERE username='".$username."'";
		
		$result = mysql_query($query);
		if(!$result) {
			throw new Exception("Can't find user's 'bm_URL'");
			return false;
		}
		
		//create an array of the URLs
		$url_array = array();
		for($count=1;$row=mysql_fetch_row($result);++$count) {
			$url_array[$count] = $row[0];
		}
		return $url_array;
		
	}

	function add_bm($new_url) {
		//add new bookmark to the database
		
		echo "Attempting to add ".htmlspecialchars($new_url)."<br />";
		$valid_user = $_SESSION['valid_user'];
		
		$conn = db_connect();
		
		//check not a repeat bookmark
		$query = "SELECT * FROM bookmark WHERE username='$valid_user' and bm_URL='".$new_url."'";
		
		$result = mysql_query($query);
		if(!$result) {
			throw new Exception("Bookmark  already exists.");			
		}
		
		//insert the new bookmark
		$query = "INSERT INTO bookmark VALUES
			('".$valid_user."', '".$new_url."')";
		
		$result = mysql_query($query);
		if(!$result) {
			throw new Exception("Bookmark could not be inserted");
		}
		
		return true;
	}
	
	function delete_bm($user, $url) {
		//delete one URL from database
		
		$conn = db_connect();
		
		$query = "DELETE FROM bookmark WHERE username='".$user."' and bm_URL='".$url."'";
		
		$result = mysql_query($query);

		if(!$result) {
			throw new Exception("Bookmark could not be deleted");
		}
		return true;		
	}

	function recommend_urls($result_user, $popularity=1) {
		
		$conn = db_connect();
		
		$query = "SELECT bm_URL FROM bookmark WHERE bm_URL NOT IN ( SELECT bm_URL FROM bookmark WHERE username='".$result_user."')";

		$result = mysql_query($query);
		
		if(!$result) {
			throw new Exception("Could not find any bookmark to recommend");
		}
		
		$urls = array();
		//build an array of the relevant urls
		for($count=0;$row=mysql_fetch_array($result);$count++) {
			$urls[$count] = $row['bm_URL'];
		}
		return $urls;
	}
	
	
?>




































































