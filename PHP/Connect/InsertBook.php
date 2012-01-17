<html>
	<head>
		<title>Book-O-Rama Book Entry Results</title>
	</head>
	<body>
		<h1>Book-O-Rama Book Entry Results</h1>
		<?php
			//짧은 스타일의 변수로 만든다.
			$isbn=$_POST['isbn'];
			$author=$_POST['author'];
			$title=$_POST['title'];
			$price=$_POST['price'];

			if(!$isbn||!$author||!$title||!$price) {
				echo "You have not entered all the required details.<br />".
					"Please go back and try again.";
				exit;
			}

			if(!get_magic_quotes_gpc()) {
				$isbn = addslashes($isbn);
				$author = addslashes($author);
				$title = addslashes($title);
				$price = addslashes($price);
			}
			
			include_once('Acess.php');

			$query = "INSERT INTO books VALUES ('".$isbn."', '".$price."', '".$title."', '".$price."')";
			echo $query."<br />";

			$result = mysql_query($query);
			
			if(!$result) {
				echo "An error has occured. The item was not added.";
			} else {
				 echo $db->affected_rows."book inserted into database.";
			}
		?>
 </body>
</html>