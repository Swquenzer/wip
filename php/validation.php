<?php
	function regValidate($user, $email, $pass1, $pass2) {
		global $errors;
		require 'include/db_connect.php';
		$check = $dbHandle->prepare("SELECT (?) FROM members WHERE ?=(?)");
		$check->bind_param('sss', $select, $select, $dbCheck);
		###Verify that username is of correct form- alphanumeric or underscore, 4-16 characters
		if(!preg_match('/^\S[a-zA-Z0-9_]{4,16}$/', $_POST['username'])) {
			$errors[] = "Incorrect username";        
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
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,16}$/', $pass1)) {
			$errors[] = "Password needs to be at least 6 characters with at least 1 number and no spaces";
		}
		###Check that passwords match
		if ($_POST['pass'] != $_POST['pass2']) {
			$errors[] = "Passwords don't match";
		}
		return $errors;
	}
?>