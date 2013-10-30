<?php include 'include/header.php'; ?>
<!-- Put any page-specific head elements here -->
<link rel="stylesheet" type="text/css" media="all" href="css/login.css">
</head>
<?php include 'include/nav.php'; ?>
		<div id="pageContent">
			
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<span id="contentHeader"><h1>Login</h1></span>
				<?php
						$continue = true;
						include "include/db_connect.php";
						if (!mysqli_select_db($dbHandle, "wip")) {
							//throw new Exception("Could not connect to database");
						}
						//Check for cookie
						if(isset($_COOKIE['ID_my_site']) & $continue == true) {
							$username = $_COOKIE['ID_my_site'];
							$pass = $_COOKIE['Key_my_site'];
							$check = mysqli_query($dbHandle,   "SELECT * FROM members
																WHERE email = '$username'")
									or errors("queryUnsuccessful");
							while($info = mysqli_fetch_array($check)) {
								if($pass != $info['password']) { 
								} else {
									###TAKE OFF WIP
									header("Location: members/".$username."/workstation.php");
								}
							}
						}
						if(isset($_POST['submit']) & $continue == true) {
							if(!$_POST['email'] | !$_POST['pass'] & $continue == true) {
								errors("emptyForm",$continue);
							}
							### Check against database
							/*if magic quotes is enabled
							if (!get_magic_quotes_gpc() & $continue == true) {
								$_POST['email'] = addslashes($_POST['email']);
							
							*/
							$query = "SELECT * 
									  FROM members
									  WHERE email = '".$_POST['email']."'";
							$check = mysqli_query($dbHandle,$query); //Error handling
							//if doesn't exist
							$check2 = mysqli_num_rows($check);
							if($check2 == 0 & $continue == true) {
								errors("logEmailNull",$continue);
							}
							while($continue & $info = mysqli_fetch_array($check)) {
								$_POST['pass'] = stripslashes($_POST['pass']);
								$info['password'] = stripslashes($info['password']);
								$_POST['pass'] = md5($_POST['pass']);
								//if password is wrongs
								if($_POST['pass'] != $info['password'] & $continue == true) {
									errors("wrongPass",$continue);
								} elseif ($continue == true) {
									//Get username from user with correct email
									$query = "SELECT username FROM members WHERE email='".$_POST['email']."'";
									$getUsernameResult = mysqli_query($dbHandle,$query);
									$usernameArray = mysqli_fetch_array($getUsernameResult);
									//If login ok, add cookie
									$hour = time() + 3600;
									setcookie('ID_my_site', $usernameArray[0], $hour);
									setcookie('Key_my_site', $_POST['pass'],$hour);
									//redirect to members area
									header("Location: ".$clientRootDir."members/".$usernameArray[0]."/workstation.php");
								}
							} //end while
						} //end if
						else { 
					/*
					 ### CATCH ERRORS ###
					 catch(Exception $e) {
						echo "Error: " . $e->getMessage();
						echo '<br><a href="'.$_SERVER["PHP_SELF"].'">Try again?</a>';
					}
					*/
						?>
						<form id="globalForm" name="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
							<fieldset>
								<div id="globalFormContainer">
									<p>
									<label>Email Address:</label>
									<input type="text" name="email" placeholder="Your Email Address" maxlength="32" required="required" autofocus>
									</p>
									<p>
									<label>Password:</label>
									<input type="password" name="pass" maxlength="32">
									</p>
									 <input type="submit" name="submit" value="Login"> 
								</div>
							</fieldset>
						</form>
						<?php 
						} //end else
					?> 
					 <h1>Not a member yet?</h1>
					 <p>
						<h3><a href="register.php">Click here</a> to begin developing your very own portfolio!</h3>
					 </p>
			</div> <!--End col2-->
			<?php include "include/col3_footer.php"; ?>