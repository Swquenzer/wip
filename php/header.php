<?php
		### PHP Functions ###
		require SERVER_ROOT_DIR.'/php/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
	<?php
		### Server ROOT ###
		$filePath = dirname(__FILE__);
		$filePath = str_replace("\php","",$filePath);
		define('SERVER_ROOT_DIR', $filePath);
		### Client ROOT ###
		$clientRootDir = "/wip/";
		//Connect to database
		require SERVER_ROOT_DIR.'/php/db_connect.php';
		mysqli_select_db($dbHandle, "wip"); //Error Handling
		//Check cookies for login info
		if(isset($_COOKIE['ID_my_site'])) {
			$username = $_COOKIE['ID_my_site'];
			$pass = $_COOKIE['Key_my_site'];
			$check = mysqli_query($dbHandle,"Select * FROM members
								   WHERE username = '".$username."'");
			while($info = mysqli_fetch_array($check)) {
				if ($pass != $info['password']) {
					echo "Made it in!";
					echo '
						<script type="text/javascript">
							window.onload = function(){
							document.getElementById(\'loginLinkA\').innerHTML="Login<br>(guest)";
							};
						</script>
						 ';
				} else {
					echo '
						<script type="text/javascript">
							window.onload = function(){
							document.getElementById(\'loginLinkA\').innerHTML="Welcome, <br><h6>'.$username.'</h6>";
							document.getElementById(\'loginLinkA\').href="'.$clientRootDir.'members/'.$username.'/workstation.php";
							};
						</script>
						 ';
				}
			}
		} else {
			echo '
						<script type="text/javascript">
							window.onload = function(){
								document.getElementById(\'loginLinkA\').innerHTML="Login<br><h6>(guest)</h6>";
							};
						</script>
						 ';
		}
	echo '

			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="keywords" content="wip, inspiration, motivation, project">
			<meta name="description" content="Work in Progress">
			<meta name="author" content="Stephen Quenzer">
			<title>A Work in Progress</title>
			<link rel="stylesheet" type="text/css" media="all" href="'.$clientRootDir.'css/global.css">
			<script type="text/javascript" src="'.$clientRootDir.'js/global.js"></script>
		<!--<link rel="icon" type="image/x-icon" href="'.$clientRootDir.'favicon.ico">-->
		<!--<link href="http://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet" type="text/css">-->
	';
	
	?>
	
