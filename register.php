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
<?php
	include 'include/nav.php'; ?>
		<div id="pageContent">
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<?php
				$showForm = false;
					if(isset($_POST['submit'])) {
						require 'php/validation.php';
						$errors = regValidate($_POST['username'], $_POST['email'], $_POST['pass'], $_POST['pass2']);
						### If no errors ###
						if($showForm = empty($errors)) {
							//Create password hash using salt with blowfish cipher and cost set to 10
							$passHash = generateHash($_POST['pass']);
							//Note: $current holds current time in SQL DATETIME format (initialized in header.php)
							$insert =  $dbHandle->prepare("INSERT INTO members (username, email, password, join_date, last_seen) VALUES (?,?,?,?,?)");
							$insert->bind_param('sssss', $user, $mail, $passHash, $current, $current);
							$user = $_POST['username'];
							$mail = $_POST['email'];
							if(!$insert->execute()) {
								printf("Error executing query: %s\n",$dbHandle->error);
							}
							//Create Member Page
							$sourceDir = getcwd()."\\members\\".$_POST['username'];
							$destFile = $sourceDir."\\workstation.php";
							if(mkdir($sourceDir,0777) & copy(getcwd()."/member.php", $destFile)) {
								echo '<span class="outsideShadow"><h1>Registered</h1></span>
									  <p id="registered">Thank you for registering, you may now <a href="login.php">login</a>.</p>
									 ';
							}
						}
					}
					if(!$showForm) {
						 echo '
						<span class="outsideShadow"><h1>Register</h1></span>
						';
						 ?>
						 <form id="globalForm" name="register" action=
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
								<?php
									if(!empty($errors)) {
										echo "<span class='errMsg'><ul>";
										foreach($errors as $e) {
											echo "<li>$e</li>";
										}
										echo "</ul></span>";
									}
								?>
								</div>
							</fieldset>
						</form>
						 <?php
					}
					?> 
				</p>
			</div> <!--End col2-->
			<?php include "include/col3_footer.php"; ?>