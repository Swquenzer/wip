<?php
######################################################################
###	Content: PHP Functions			
###	Author: Stephen Quenzer
### Date Created: May 18, 2013
### Date Modified: May 18, 2013
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
					dLog('An error occured.');
					break;
			}
			echo '<br><a href="'.$_SERVER["PHP_SELF"].'">Try again?</a>';
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
function cookieCheck($dbHandle) { //Do I need to selec db again?
	if(isset($_COOKIE['ID_my_site'])) {
		$username = $_COOKIE['ID_my_site'];
		$pass = $_COOKIE['Key_my_site'];
		$check = mysqli_query($dbHandle,   "SELECT * FROM members
											WHERE email = '$username'")
				or errors("queryUnsuccessful"); //Proper error handling
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
?>

