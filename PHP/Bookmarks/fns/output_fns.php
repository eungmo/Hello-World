<?php
function do_html_header($title)
{
	//HTML 헤더와 바디 일부
?>
<html>
	<head>
		<title><?php echo $title;?></title>
		<style>
			body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
			li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
			hr { color: #3333cc; width=300px; text-align: left }
			a { color: #000000 }
		</style>		
	</head>
	<body>
		<img src="../images/bookmark.gif" alt="PHPbookmark logo" border="0"
			align="left" valign="bottom" height="55" width="57" />
		<h1>PHPbookmark</h1>
		<hr/>
			
<?php
	if($title) {
		do_html_heading($title);
	}
}

function do_html_footer() {
	//HTML 아래 부분
	?>
	</body>
	</html>
<?php
}

function do_html_heading($heading) {
	//헤드를 출력한다.
?>
	<h2><?php echo $heading;?></h2>
<?php
}

function do_html_URL($url, $name) {
	//URL과 이름을 출력
	echo "<br/><a href=".$url.">".$name."</a><br />";

}

function display_site_info() {
	//사이트 정보
?>
	<ul>
		<li>Store your bookmarks online with us!</li>
		<li>See what other users use!</li>
		<li>Share your favorite links with others!</li>
	</ul>
<?php
}

function display_login_form() {
	//로그인  상자
?>
	<!-- 클릭하면 회원등록 페이지로 이동-->						
	<p></p><a href="../member/register_form.php">Not a member?</a></p>
	<!-- member.php에 출력-->
	<form method="post" action="../member/member.php">				<!----------------------------------------------->
		<table bgcolor="#cccccc">
			<tr>
				<td colspan="2">Members log in here:</td>
			</tr>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username"/></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="passwd"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="log in"/></td>
			</tr>
			<tr>
				<!-- 비밀번호를 잊어 버림, forgot_form.php로-->
				<td colspan="2"><a href="../member/forgot_form.php">Forgot your password?</a></td>	<!----------------------------------------------->
			</tr>
		</table>
	</form>
<?php
}

function display_registration_form() {
//회원 등록 
?>
	<!--Submit -> register_new.php로 이동-->
	<form method="post" action="../member/register_new.php">
		<table bgcolor="#cccccc">
			<tr>
				<td>Email address:</td>
				<td><input type="text" name="email" size="30" maxlength="100"/></td>
			</tr>
			<tr>
				<td>Preferred username <br />(max 16 chars):</td>
				<td valign="top"><input type="text" name="username"
					size="16" maxlength="16"/></td>
			</tr>
			<tr>
				<td>Password <br/>(between 6 and 16 chars):</td>
				<td valign="top"><input type="password" name="passwd"
					size="16" maxlength="16" /></td>
			</tr>
			<tr>
				<td>Confirm password:</td>
				<td><input type="password" name="passwd2" size="16"
					maxlength="16"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Register"></td>
			</tr>
		</table>
	</form>
<?php
}

function display_user_urls($url_array) {
	//테이블의 URL들
	
	//global변수로 테스트가능하게 함
	global $bm_table;
	$bm_table = true;
?>
	<br/>
	<form name="bm_table" action="../bookmark/delete_bms.php" method="post">
		<table width="300" cellpadding="2" cellspacing="0">
			<?php
				$color = "#cccccc";
				echo "<tr bgcolor=\"".$color."\"><td><strong>Bookmark</strong></td>";
				echo "<td><strong>Delete?</strong></td></tr>";
				if((is_array($url_array)) && (count($url_array) > 0)) {
					foreach($url_array as $url) {
						if($color == "#cccccc") {
							$color = "#ffffff";
						}
						else {
							$color = "#cccccc";
						}
						//htmlspecilachars()
						echo "<tr bgcolor\"".$color."\"><td><a href=\""
							.$url."\">".htmlspecialchars($url)."</a></td>
								<td><input type=\"checkbox\" name=\"del_me[]\"
									value=\"".$url."\"/></td>
								</tr>";
					
					}
				}
				else {
					echo "<tr><td>No bookmarks on record</td></tr>";
				}
			?>
		</table>
	</form>
<?php
}

function display_user_menu() {
	//display menu
?>
	<br />
	<a href="../member/okmember.php">Home</a> &nbsp;|&nbsp;
	<a href="../bookmark/add_bm_form.php">Add BM</a> &nbsp;|&nbsp;
<?php
	//delete option
	global $bm_table;
	//echo $bm_table;
	if($bm_table == true) {		/////////////////////////////////////////////////////////////////////////////
			echo "<a href=\"#\" onClick=\"bm_table.submit();\">Delete BM</a> &nbsp;|&nbsp;";
	}
	else {
		echo "<span sytle=\"color: #cccccc\">Delete BM</span> &nbsp;|&nbsp;";
	}
?>
	<a href="../member/change_passwd_form.php">Change Password</a>
	<br />
	<a href="../bookmark/recommend.php">Recommend URLs to me</a> &nbsp;|&nbsp;
	<a href="../member/logout.php">Logout</a>
	<hr />
	
<?php
}

function display_add_bm_form() {
	//새로운 북마크 폼
?>
	<form name="tm_table" action="../bookmark/add_bms.php" method="post">
		<table width="250" cellpadding"2" cellspacing="0" bgcolor="#cccccc">
			<tr>
				<td>New BM:</td>
				<td><input type="text" name="new_url" value="http://"
					size="30" maxlength="255"/></td>
			</tr>
			<tr>
				<td colspan="3" align="center">
					<input type="submit" value="Add bookmark"/></td>
			</tr>
		</table>
	</form>
<?php
}

function display_password_form() {
	//패스워드 변경
?>
	<br />
	<form action="../member/change_passwd.php" method="post">
		<table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
			<tr>
				<td>Old password:</td>
				<td><input type="password" name="old_passwd"
						size="16" maxlength="16"/></td>
			</tr>
			<tr>
				<td>New password:</td>
				<td><input type="password" name="new_passwd"
						size="16" maxlength="16"/></td>
			</tr>
			<tr>
				<td>Repeat new password:</td>
				<td><input type="password" name="new_passwd2"
						size="16" maxlength="16"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Change password"/>
				</td>
			</tr>
		</table>
		<br />
	</form>	
<?php
}

function display_forgot_form() {
	//display HTML form to reset and email password
?>
	<br />
	<form action="../member/forgot_passwd.php" method="post">
		<table width="250" cellpadding="3" cellspacing="0" bgcolor="#cccccc">
			<tr>
				<td>Enter your username</td>
				<td><input type="text" name="username" size="16" maxlength="16" /></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Change password"/>
				</td>
			</tr>
		</table>
	</form>
<?php
}
	
function display_recommended_urls ($url_array) {
//dis_play_urls???????????????
?>
	<br />
	<table width="300" cellpadding="2" cellspacing="0">
<?php
	$color = "#cccccc";
	echo "<tr bgcolor=\"".$color."\">
		<td><strong>Recommendations</strong></td></tr>";
		
	//echo "<br>".(is_array($url_array))." | ".(count($url_array))."<br>";
	
	if((is_array($url_array)) && (count($url_array) > 0)) {
		foreach($url_array as $url) {
			
			if($color == "#cccccc") {
				$color = "#ffffff";	
			} 
			else {
				$color = "#cccccc";
			}
			echo "<tr bgcolor=\"".$color."\">
				<td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td></tr>";		
		}
	}
	else {
		echo "<tr bgcolor=\"".$color."\"><td><strong>No recommendations for you today.</strong></td></tr>";
	}
?>
	</table>
<?php
}
?>