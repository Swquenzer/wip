<?php include 'include/header.php'; ?>
<!-- Put any page-specific head elements here -->
<link rel="stylesheet" type="text/css" media="all" href="css/login.css">
</head>
<?php include 'include/nav.php'; ?>
		<div id="pageContent">
			//<? require ('forms/loginForm.php'); ?>
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<span id="contentHeader"><h1>Login</h1></span>
				
						<form id="globalForm" name="login" action="forms/loginForm.php" method="post">
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
					 <h1>Not a member yet?</h1>
					 <p>
						<h3><a href="register.php">Click here</a> to begin developing your very own portfolio!</h3>
					 </p>
			</div> <!--End col2-->
			<?php include "include/col3_footer.php"; ?>