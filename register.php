<?php if(!include 'include/header.php') {
		//throw new Exception("Failed to load header.php"); //Error Handling (redirect to error page)
	}
 ?>
<!-- Put any page-specific head elements here -->
<style>
	#registered {
		text-align: center;
		display: block;
		margin: 10px;
		font-family: "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
	}
</style>
</head>
<?php include 'include/nav.php'; ?>
		<div id="pageContent">
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<?php
					$continue = true;
					### Connect to DB ###
					//include "include/db_connect.php";
					if(isset($_POST['submit'])) {
						### Form submitted, run code ##
						//only matters if magic quotes are enabled
						if(!get_magic_quotes_gpc() & $continue==true) {
							$_POST['username'] = addslashes($_POST['username']);
						}
						###Verify that email is unique
						$dbCheck = $_POST['email'];
						$check = $dbHandle->prepare("SELECT (?) FROM members WHERE ?=(?)");
						$check->bind_param('sss', $select, $select, $dbCheck);
						$select = "email";
						$check->execute();
						$result = $check->get_result();
						$numRows = $result->num_rows;
						//if name already exists
						if ($numRows != 0 & $continue==true) {
							errors("regUsernameInUse",$continue); //need email error message
							$contine=false;
						}
						###Verify that username is unique
						$dbCheck = $_POST['username'];
						$select = "username";
						$check->execute();
						$result = $check->get_result();
						$check->close();
						$numRows = $result->num_rows;
						//if name already exists
						if ($numRows != 0 & $continue==true) {
							errors("regUsernameInUse",$continue); //need username error message
							$continue=false;
						}
						###Check that passwords match
						if ($_POST['pass'] != $_POST['pass2'] & $continue==true) {
							errors("wrongPass",$continue);
						}
						###Create password hash using salt with blowfish cipher and cost set to 10
						$passHash = generateHash($_POST['pass']);
						//Insert information into database
						if ($continue==true) {
							#Note: $current holds current time in SQL DATETIME format (initialized in header.php)
							$insert =  $dbHandle->prepare("INSERT INTO members (username, email, password, join_date, last_seen) VALUES (?,?,?,?,?)");
							$insert->bind_param('sssss', $user, $mail, $passHash, $current, $current);
							$user = $_POST['username'];
							$mail = $_POST['email'];
							if(!$insert->execute()) {
								printf("Error executing query: %s\n",$dbHandle->error);
							}
							###Create Member Page
							$sourceDir = getcwd()."\\members\\".$_POST['username'];
							$destFile = $sourceDir."\\workstation.php";
							if(mkdir($sourceDir,0777) & copy(getcwd()."/member.php", $destFile)){
								echo '<span class="outsideShadow"><h1>Registered</h1></span>
									  <p id="registered">Thank you for registering, you may now <a href="login.php">login</a>.</p>
									 ';
							}
						}
					} else {
					 echo '
					<span class="outsideShadow"><h1>Register</h1></span>
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
									<input type="text" name="username" placeholder="5-15 characters" maxlength="32" required="required" autofocus>
								</p>
								<p>
									<label>Email Address:</label>
									<input type="text" name="email" placeholder="Your Email Address" maxlength="64" required="required">
								</p>
								<p>
									<label>Password:</label>
									<input type="password" name="pass" maxlength="32" required="required">
								</p>
								<p>
									<label>Confirm Password:</label>
									<input type="password" name="pass2" maxlength="32" required="required">
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
			<?php include "include/col3_footer.php"; ?>