<?php if(!include 'php/header.php') {
		throw new Exception("Failed to load header.php");
	}
 ?>
<!-- Put any page-specific head elements here -->
</head>
<?php include 'php/nav.php'; ?>
		<div id="pageContent">
			<?php include "php/col1.php"; ?>
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<?php
					$continue = true;
					### Connect to DB ###
					include "php/db_connect.php"; 
					if(!mysqli_select_db($dbHandle, "wip")) {
						echo "Could not connect to database";
					}

					if(isset($_POST['submit'])) {
						### Form submitted, run code ##
						//If any fields are left blank
						/*
						if(!$_POST['username'] | !$_POST['pass'] | !$_POST['pass2']) {
							errors("emptyForm",$continue);
						}
						*/
						//only matters if magic quotes are enabled
						if(!get_magic_quotes_gpc() & $continue==true) {
							$_POST['username'] = addslashes($_POST['username']);
						}
						###Verify that email is unique
						$emailCheck = $_POST['email'];
						$check = mysqli_query($dbHandle, "SELECT email
												FROM members
												WHERE email='$emailCheck'")
											or errors("queryUnsuccessful",$continue);
						$check2 = mysqli_num_rows($check);
						//if name already exists
						if ($check2 != 0 & $continue==true) {
							errors("regUsernameInUse",$continue); //need email error message
						}
						###Verify that username is unique
						$userCheck = $_POST['username'];
						$check = mysqli_query($dbHandle, "SELECT username
												FROM members
												WHERE username='$userCheck'")
											or errors("queryUnsuccessful",$continue);
						$check2 = mysqli_num_rows($check);
						//if name already exists
						if ($check2 != 0 & $continue==true) {
							errors("regUsernameInUse",$continue); //need username error message
						}
						###Check that passwords match
						if ($_POST['pass'] != $_POST['pass2'] & $continue==true) {
							errors("wrongPass",$continue);
						}
						//encrypt password 
						$_POST['pass'] = md5($_POST['pass']);
						//if magic quotes are enabled
						if (!get_magic_quotes_gpc() & $continue==true) {
							$_POST['pass'] = addslashes($_POST['pass']);
							$_POST['username'] = addslashes($_POST['username']);
							$_POST['email'] = addslashes($_POST['email']);
						}
						//Insert information into database
						if ($continue==true) {
							$insert =  "INSERT INTO members (username, email, password)
										VALUES ('" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . $_POST['pass'] . "');";
							echo $insert;
							if(!mysqli_query($dbHandle,$insert)) {
								echo "Query did not work correctly";
							}
							###Create Member Page
							$sourceDir = getcwd()."\\members\\".$_POST['username'];
							$destFile = $sourceDir."\\workstation.php";
							if(mkdir($sourceDir,0777) & copy(getcwd()."/member.php", $destFile)){
								echo '<h1>Registered</h1>
									 '.$destFile.'
									  <p>Thank you for registering, you may now <a href="login.php">login</a>.</p>
									 ';
							}
						}
					} else {
					 echo '
					 <h1>Register</h1>
					 <p>
					 ';
					 ?>
					 <form id="globalForm" onsubmit="return validateForm();" name="register" action=
												<?php echo htmlentities($_SERVER['PHP_SELF']); ?>
												" method="post">
						<fieldset>
							<div id="globalFormContainer">
								<p>
								<label>Username:</label>
								<input type="text" name="username" placeholder="5-15 characters" maxlength="32">
								</p>
								<p>
								<label>Email Address:</label>
								<input type="text" name="email" placeholder="Your Email Address" maxlength="64">
								</p>
								<p>
								<label>Password:</label>
								<input type="password" name="pass" maxlength="32">
								</p>
								<p>
								<label>Confirm Password:</label>
								<input type="password" name="pass2" maxlength="32">
								</p>
								<input type="submit" name="submit" value="Register">
							</div>
						</fieldset>
					</form>
					 <?php
					}
					?> 
				</p>
			</div> <!--End col2-->
			<?php include "php/col3_footer.php"; ?>