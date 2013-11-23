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
//Generate a hash using blowfish for salt
function generateHash($password) {
	$salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
	$salt = base64_encode($salt);
	$salt = str_replace('+','.', $salt);
	$salt = "$2y$10$".$salt."$";
	$password = crypt($password, $salt);
	return $password;
}
//Verify password
function verifyPass($userPass, $hashedPass) {
	if (crypt($userPass, $hashedPass)== $hashedPass) {
		return true;
	}
	return false;
}
//If user is logged in (a cookie is set), return true
function cookieCheck($dbHandle) {
	require SERVER_ROOT_DIR . '/include/db_connect.php';
	if(isset($_COOKIE['ID_my_site'])) {
		global $cookie,$username,$pass;
		$cookie = true;
		$username = $_COOKIE['ID_my_site'];
		$pass = $_COOKIE['Key_my_site'];
		if(!($check = $dbHandle->query("SELECT * FROM members WHERE username = '$username'"))) {
			printf("An error occured while processing query: %s\n",$dbHandle->error);
		}
		while($info = $check->fetch_array()) {
			$check->free();
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
	$query = "SELECT portfolio.name FROM portfolio LEFT JOIN members ON portfolio.member_id=members.id WHERE members.username='".$user."'";
	$qResults = $handle->query($query); //Error Handling
	return $qResults;
}
function getPortInfo($handle, $user, $port) {
	$query = "SELECT portfolio.* FROM portfolio LEFT JOIN members ON portfolio.member_id=members.id WHERE members.username='".$user."'";
	$qResults = $handle->query($query); //Error Handling
	while($row = $qResults->fetch_array(MYSQLI_ASSOC)) {
		if(str_replace(" ", "", strtolower($row['name'])) == $port) {
			$qResults->free();
			return $row;
		}
	}
}
?>

