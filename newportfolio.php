<?php include 'include/header.php'; ?>
<!-- Put any page-specific head elements here -->
<style>
	#globalForm label {
		display: inline;
		width: auto;
		margin-right: 10px;
	}
	#globalForm input[name="portName"] {
		width: 63%;
	}
	#globalForm input[type="submit"] {
		width: 50%;
	}
	#globalForm input[type="checkbox"] {
		position: relative;
		top: 11px;
	}
</style>
</head>
<?php 
	include 'include/nav.php';
	if(isset($_POST["submit"])) {
		//Determine if visibility is private (0) or public (otherwise)
		if($POST_['visibility']=='public') {
		$vis = 1; 
		} else { 
		$vis = 0; 
		}
		//Get member ID
		$queryMemID = "SELECT id FROM members WHERE username='".$username."'";
		$qReturn = mysqli_query($dbHandle,$queryMemID);
		$idArray = mysqli_fetch_array($qReturn);
		$insert =  "INSERT INTO portfolio (member_id, name, description, creation_date, public)
					VALUES (".$idArray[0].",'".$_POST["portName"]."','".$_POST["portDescription"]."','".$current."',".$vis.")";
		if(!mysqli_query($dbHandle,$insert)) {
			dLog("Query did not execute correctly");
		}
		if(isset($_POST[newProject])) {
			//display project creation form
		}
		//Create new portfolio page for user_error
		$portName = str_replace( ' ', '', $_POST['portName']);
		dLog("Portfolio name for URL: " . $portName);
		$sourceDir = getcwd()."\\members\\".$username;
		$destFile = $sourceDir."\\".$portName.".php";
		if(mkdir($sourceDir,0777) & copy(getcwd()."/portfolio.php", $destFile)){
			echo '<span class="outsideShadow"><h1 id="registered">Portfolio Created</h1></span>
				 '.$destFile.'
				  <p>Thank you for registering, you may now <a href="login.php">login</a>.</p>
				 ';
		}
		//Redirect to member's page
		header("Location: ".$clientRootDir."members/".$username."/".$portName.".php");
	}	
 ?>

		<div id="pageContent">
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<span class="outsideShadow"><h1>Portfolio Form</h1></span>
				<form id="globalForm" onsubmit="return validateForm();" name="portfolio" action=
												<?php echo htmlentities($_SERVER['PHP_SELF']); ?>
												" method="post">
						<fieldset>
							<div id="globalFormContainer">
								<p>
									<label>Portfolio Name:</label>
									<input type="text" name="portName" placeholder="Speed Drawing" maxlength="32" required="required" autofocus>
								</p>
								<p>
									<label>Description: (optional)</label> <br><br>
									<textarea cols="60" rows="5" name="portDescription" placeholder="What type of portfolio will this be?"></textarea>
								</p>
								<p>
								<label> Visibility:</label> <br><br>
										<input type="radio" name="visibility" value="public" checked="checked">
										Public <br>
										<input type="radio" name="visibility" value="private">
										Private
								</p>
								<p>
									<label>Initialize portfolio with new project: </label>
									<input type="checkbox" name="newProject" value="newProject" onblur="displayProjectForm()">
								</p>
								<br>
								<input type="submit" id="portSubmit" name="submit" value="Create Portfolio">
							</div>
						</fieldset>
					</form>
			</div> <!--End col2-->
			<?php include "include/col3_footer.php"; ?>