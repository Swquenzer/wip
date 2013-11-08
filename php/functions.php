<?php
######################################################################
###	Content: PHP Functions			
###	Author: Stephen Quenzer
### Date Created: May 18, 2013
### Date Modified: Oct 31, 2013
######################################################################

//Error Handling
//Created: May 16, 2013
//Modified:
function errors($errorType,&$continue) {
			$continue = false;
			switch ($errorType) {
				case "emptyForm":
					echo 'You didn\'t complete all of the required fields';
					dLog('You didn\'t complete all of the required fields');
					break;
				case "queryUnsuccessful":
					echo 'Query unsuccessful';
					dLog('Query unsuccessful');
					break;
				case "regUsernameInUse":
					echo 'The email ' . $_POST['username'] . ' is already in use';
					dLog('The email ' . $_POST['username'] . ' is already in use');
					break;
				case "wrongPass":
					echo 'Your passwords don\'t match';
					dLog('Your passwords don\'t match');
					break;
				case "dbConnectError":
					echo 'The email ' . $_POST['username'] . ' is already in use';
					dLog('The email ' . $_POST['username'] . ' is already in use');
					break;
				case "logEmailNull":
					echo 'No account exists with that email';
					dLog('No account exists with that email');
					break;
				default:
					dLog('An error occurred.');
					break;
			}
			echo '<br>';
}
//Simple debugging log
function dLog($message) {
	$log = "dlog.txt";
	//get current file contents
	$contents = file_get_contents($log);
	//Append new contents onto new line
	$contents.= "[".date("g:i a")."]:" .$message . "\r\n";
	file_put_contents($log, $contents);
}
//If user is logged in (a cookie is set), return true
function cookieCheck($dbHandle) { 
	mysqli_select_db($dbHandle, "wip"); //Error Handling
	if(isset($_COOKIE['ID_my_site'])) {
		global $cookie,$username,$pass;
		$cookie = true;
		$username = $_COOKIE['ID_my_site'];
		$pass = $_COOKIE['Key_my_site'];
		$check = mysqli_query($dbHandle,   "SELECT * FROM members
											WHERE username = '$username'")
				or dLog("Query Error"); //Proper error handling
		while($info = mysqli_fetch_array($check)) {
			if($pass != $info['password']) { 
				return false;
			} else {
				return true;
			}
		}
	}
	return false;
}
function getPortList($handle, $user) {
	$query = 	"SELECT portfolio.name FROM portfolio LEFT JOIN members ON portfolio.member_id=members.id WHERE members.username='".$user."'";
	$qResults = mysqli_query($handle, $query);
	return $qResults;
}
function getPortInfo($handle, $user, $port) {
	$query = 	"SELECT portfolio.* FROM portfolio LEFT JOIN members ON portfolio.member_id=members.id WHERE members.username='".$user."'";
	$qResults = mysqli_query($handle, $query);
	while($row = mysqli_fetch_array($qResults, MYSQLI_NUM)) {
		if(str_replace(" ", "", $row[2]) == $port) {
			dLog($port);
			return $row;
		}
	}
}
?>

