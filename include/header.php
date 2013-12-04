<?php
	$cookie;$username;$pass;
	date_default_timezone_set('America/New_York');
	$current = date("Y-m-d H:i:s");
	### Server ROOT ###
	$filePath = dirname(__FILE__);
	$filePath = str_replace("\include","",$filePath);
	define('SERVER_ROOT_DIR', $filePath);
	### Client ROOT ###
	$clientRootDir = "/wip/";
	### PHP Functions ###
	include SERVER_ROOT_DIR.'/php/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
	<?php
echo <<<HEAD
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="wip, inspiration, motivation, project">
		<meta name="description" content="Work in Progress">
		<meta name="author" content="Stephen Quenzer">
		<title>A Work in Progress</title>
		<link rel="stylesheet" type="text/css" media="all" href="{$clientRootDir}css/global.css">
		<script type="text/javascript" src="{$clientRootDir}js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="{$clientRootDir}js/global.js"></script>
		<!--<link rel="icon" type="image/x-icon" href="{$clientRootDir}favicon.ico">-->
		<link href="http://fonts.googleapis.com/css?family=Tangerine:700" rel="stylesheet" type="text/css">
HEAD;
		//Connect to database
		include SERVER_ROOT_DIR.'/include/db_connect.php';
		//Check cookies for login info
		if(!cookieCheck($dbHandle)) {
			$cookie = false;
			?>
				<script>
					$(document).ready(function() {
						guestLink();
					});
				</script>
			<?php
		} else {
			$cookie = true;
			//Update "last_seen" in db
			$query = $dbHandle->prepare("UPDATE members SET last_seen=? WHERE username=?");
			$query->bind_param('ss', $current, $username);
			if(!$query->execute()) {
				printf("Error executing query: %s\n",$dbHandle->error);
			}
			echo "
				<script>
					$(document).ready(function() {
						memberLink('$username', '$clientRootDir');
					});
				</script>
				 ";
		//$query->close();
		}
	?>
	
