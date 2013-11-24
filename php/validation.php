<?php
	function regValidate($user, $email, $pass1, $pass2) {
		global $errors;
		require 'include/db_connect.php';
		$check = $dbHandle->prepare("SELECT (?) FROM members WHERE ?=(?)");
		$check->bind_param('sss', $select, $select, $dbCheck);
		###Verify that username is of correct form- alphanumeric or underscore, 4-16 characters
		if(!preg_match('/^\S[a-zA-Z0-9_]{4,16}$/', $_POST['username'])) {
			$errors[] = "Username needs to be at least 4 characters long: letters, numbers, and underscores are accepted";        
		}
		###Verify that email is of correct form
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Incorrect email address";
		}
		###Verify that email is unique
		$dbCheck = $email;
		$select = "email";
		$check->execute();
		$result = $check->get_result();
		$numRows = $result->num_rows;
		if ($numRows != 0) {
			$errors[] = "Email already in use";
		}
		###Verify that username is unique
		$dbCheck = $user;
		$select = "username";
		$check->execute();
		$result = $check->get_result();
		$check->close();
		$numRows = $result->num_rows;
		if ($numRows != 0) {
			$errors[] = "Username already in use";
		}
		###Verify that password meets requirements
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%\(\)]{6,16}$/', $pass1)) {
			$errors[] = "Password needs to be at least 6 characters with at least 1 number and letter";
		}
		###Check that passwords match
		if ($_POST['pass'] != $_POST['pass2']) {
			$errors[] = "Passwords don't match";
		}
		return $errors;
	}
	function loginValidate($email, $pass) {
		global $errors;
		require 'include/db_connect.php';
		### Check against database
		$query = $dbHandle->prepare("SELECT * FROM members WHERE email = ?");
		$query->bind_param('s', $email);
		$query->execute(); //Error handling
		$result = $query->get_result();
		//If email doesn't exist
		$numRows = $result->num_rows;
		if($numRows == 0) {
			$errors = "Account with email $email doesn't exist";
			return $errors;
		}
		while($info = $result->fetch_assoc()) {
			$info['password'] = stripslashes($info['password']);
			//if password is wrong
			if(!verifyPass($pass, $info['password'])) {
				$errors = "Incorrect username or password";
				return $errors;
			} else {
				//Get username from user with correct email
				$query = $dbHandle->prepare("SELECT username FROM members WHERE email=?");
				$query->bind_param('s', $email);
				$query->execute();
				$getUsernameResult = $query->get_result();
				$usernameArray = $getUsernameResult->fetch_array();
				//If login ok, add cookie
				$hour = time() + 3600;
				//dLog("info['password']: " . $info['password']);
				setcookie('ID_my_site', $usernameArray[0], $hour);
				setcookie('Key_my_site', $info['password'], $hour);
				//redirect to members area
				header("Location: ".$clientRootDir."members/".$usernameArray[0]."/workstation.php");
			}
		} //end while
	}
?>