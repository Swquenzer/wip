<?php include 'include/header.php'; ?>
<!-- Put any page-specific head elements here -->
<link rel="stylesheet" type="text/css" media="all" href="css/login.css">
<style>
	.errMsg {
		text-align: center;
		margin-bottom: 5px;
	}
</style>
</head>
<?php include 'include/nav.php'; ?>
		<div id="pageContent">
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<span class="outsideShadow"><h1>Login</h1></span>
						<?php 
						//If user already logged in, redirect to member's page
						if($cookie) {
							header("Location: members/".$username."/workstation.php");
						}
						if(isset($_POST['submit'])) {
							require 'php/validation.php';
							$errors = loginValidate($_POST['email'], $_POST['pass']);
						} //end if
						?>
						<form id="globalForm" name="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
							<fieldset>
								<div id="globalFormContainer">
									<?php
										if(!empty($errors)) {
											echo "<span class='errMsg'>*$errors</span>";
										}
									?>
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