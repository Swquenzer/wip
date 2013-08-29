<?php require 'php/header.php'; ?>
		<div id="pageContent">
			<?php require "php/col1.php"; ?>
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<span id="contentHeader"><h1>Login</h1></span>
				<?php
						$continue = true;
						require "php/db_connect.php";
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
									$getUsernameQuery = "SELECT username FROM members WHERE email='".$_POST['email']."'";
									$getUsernameResult = mysqli_query($dbHandle,$getUsernameQuery);
									$usernameArray = mysqli_fetch_array($getUsernameResult);
									
									//if login ok, add cookie
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
						<form name="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> 
						 <table border="0"> 
						 <tr><td colspan=2></td></tr> 
						 <tr><td><label>Email Address:</label></td><td> 
						 <input type="text" name="email" maxlength="40"> 
						 </td></tr> 
						 <tr><td><label>Password:</label></td><td> 
						 <input type="password" name="pass" maxlength="50"> 
						 </td></tr> 
						 <tr><td colspan="2" align="right"> 
						 <input type="submit" name="submit" value="Login"> 
						 </td></tr> 
						 </table> 
						 </form> 
						 <br>
						 <?php 
						} //end else
					?> 
					 <h1>Not a member yet?</h1>
					 <p>
						<h3><a href="register.php">Click here</a> to begin developing your very own portfolio!</h3>
					 </p>
			</div> <!--End col2-->
			<?php require "php/col3_footer.php"; ?>