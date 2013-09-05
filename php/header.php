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
	### If current page is member.php ###
	if (preg_match("/members/",$_SERVER["SCRIPT_NAME"])) {
		echo ' 
			<link rel="stylesheet" type="text/css" media="all" href="'.$clientRootDir.'css/members.css">
			 ';
	}
	if ($_SERVER["SCRIPT_NAME"] == "login.php") {
		echo '
			<link rel="stylesheet" type="text/css" media="all" href="css/login.css">
			 ';
	}
	### If current page is index.php ###
	if ($_SERVER["SCRIPT_NAME"] == $clientRootDir . "index.php") {
		echo '
			<!--custom index css-->
			<style type="text/css">
			   #colMain {margin-top: 0;}
			 </style>
			 <!--Get resources for carousel-->
			<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
			<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
			<link rel="stylesheet" type="text/css" media="all" href="css/carousel/skin.css">
			<link rel="stylesheet" type="text/css" media="all" href="css/index.css">
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#mycarousel").jcarousel({
						
					});
				});
			</script>
		';
	}
	echo '
		</head>
		<body>
		<div id="wrapper">
			<div id="header">
				<div id="navBar">
					<ul id="navList">
						<li><a href="/wip/index.php">Home</a></li>
						<li><a href="#">Projects</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Contact</a></li>
						<li id="loginLink"><a id="loginLinkA" href="/wip/login.php">Default</a></li>
					</ul>
				</div> <!--End Nav Bar-->
				<h1>A Work in Progress</h1>
			</div> <!--End Header-->
		';
	?>
	