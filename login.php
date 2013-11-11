<?php include 'include/header.php'; ?>
<!-- Put any page-specific head elements here -->
<link rel="stylesheet" type="text/css" media="all" href="css/login.css">
</head>
<?php include 'include/nav.php'; ?>
		<div id="pageContent">
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<span class="outsideShadow"><h1>Login</h1></span>
						<?php 
						$continue = true;
						//If user already logged in, redirect to member's page
						if($cookie) {
							header("Location: members/".$username."/workstation.php");
						}
						if(isset($_POST['submit']) & $continue == true) {
							if(!$_POST['email'] | !$_POST['pass'] & $continue == true) {
								errors("emptyForm",$continue);
							}
							### Check against database
							$query = "SELECT * 
									  FROM members
									  WHERE email = '".$_POST['email']."'";
							$qResult = $dbHandle->query($query); //Error handling
							//If email doesn't exist
							$numRows = $qResult->num_rows;
							if($numRows == 0 & $continue) {
								errors("logEmailNull",$continue);
							}
							while($continue & $info = $qResult->fetch_array()) {
								$_POST['pass'] = stripslashes($_POST['pass']);
								$info['password'] = stripslashes($info['password']);
								$_POST['pass'] = md5($_POST['pass']);
								//if password is wrong
								if($_POST['pass'] != $info['password'] & $continue == true) {
									errors("wrongPass",$continue);
								} elseif ($continue == true) {
									//Get username from user with correct email
									$query = "SELECT username FROM members WHERE email='".$_POST['email']."'";
									$getUsernameResult = $dbHandle->query($query); //Error Handling
									$usernameArray = $getUsernameResult->fetch_array();
									//If login ok, add cookie
									$hour = time() + 3600;
									setcookie('ID_my_site', $usernameArray[0], $hour);
									setcookie('Key_my_site', $_POST['pass'], $hour);
									//redirect to members area
									header("Location: ".$clientRootDir."members/".$usernameArray[0]."/workstation.php");
								}
							} //end while
						} //end if
						?>
						<form id="globalForm" name="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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
						//} //end else
					?> 
					 <span class="outsideShadow"><h1>Not a member yet?</h1></span>
					 <p>
						<h3><a href="register.php">Click here</a> to begin developing your very own portfolio!</h3>
					 </p>
			</div> <!--End col2-->
			<?php include "include/col3_footer.php"; ?>