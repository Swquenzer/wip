<?php require 'php/header.php'; ?>
		<div id="pageContent">
			<?php require "php/col1.php"; ?>
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<?php
					$continue = true;
					### Connect to DB ###
					require "php/db_connect.php";
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
						$emailCheck = $_POST['email'];
						$check = mysqli_query($dbHandle, "SELECT email
												FROM members
												WHERE email='$emailCheck'")
											or errors("queryUnsuccessful",$continue);
						$check2 = mysqli_num_rows($check);
						//if name already exists
						if ($check2 != 0 & $continue==true) {
							errors("regUsernameInUse",$continue);
						}
						//Check that passwords match
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
					 <form onsubmit="return validateForm();" name="register" action="';
					 echo htmlentities($_SERVER['PHP_SELF']); ?>
					 " method="post">
					 <table border="0">
					 <tr><td><label>Username:</label></td><td>
					 <input type="text" name="username" maxlength="32">
					 </td></tr>
					 <tr><td><label>Email Address:</label></td><td>
					 <input type="text" name="email" maxlength="64">
					 </td></tr>
					 <tr><td><label>Password:</label></td><td>
					 <input type="password" name="pass" maxlength="32">
					 </td></tr>
					 <tr><td><label>Confirm Password:</label></td><td>
					 <input type="password" name="pass2" maxlength="32">
					 </td></tr>
					 <tr><th colspan=2><input type="submit" name="submit" 
					value="Register"></th></tr> </table>
					 </form>
					 <?php
					}
					?> 
				</p>
			</div> <!--End col2-->
			<?php require "php/col3_footer.php"; ?>