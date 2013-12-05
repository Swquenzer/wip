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
	.errMsg {
		margin-top: 5px;
		width: 100%;
	}
</style>
</head>
<?php 
	include 'include/nav.php';
	if(isset($_POST["submit"])) {
		### Validate form
		require 'php/validation.php';
		$errors = portValidate($_POST['portName']);
		### Process form
		if(empty($errors)) {
			### Determine if visibility is private (0) or public (otherwise)
			if($_POST['visibility']=='public') {
			$vis = 1; 
			} else { 
			$vis = 0; 
			}
			### Insert portfolio information into database
			$query = "SELECT id FROM members WHERE username=?";
			$qPrepare = $dbHandle->prepare($query);
			$qPrepare->bind_param('s',$username);
			$qPrepare->execute();
			$idArray = $qPrepare->get_result();
			$result = $idArray->fetch_array(MYSQL_NUM);
			$qPrepare->close();
			$insert =  "INSERT INTO portfolio (member_id, name, description, creation_date, public)
						VALUES (?,?,?,?,?)";
			$qPrepare = $dbHandle->prepare($insert);
			$qPrepare->bind_param('sssss', $result[0], $_POST["portName"], $_POST["portDescription"], $current, $vis);
			if(!$qPrepare->execute()) {
				printf("Error processing query: %s\n", $dbHandle->error);
			}
			if(isset($_POST['newProject'])) {
				#Deal with project form
			}
			//Create new portfolio page 
			$portName = str_replace( ' ', '', $_POST['portName']);
			$portName = strtolower($portName);
			$sourceDir = getcwd()."\\members\\".$username;
			$destFile = $sourceDir."\\".$portName.".php";
			if(!mkdir($sourceDir,0777) & copy(getcwd()."/portfolio.php", $destFile)){
				printf("Error processing new porfolio page");
			}
			//Redirect to member's page
			header("Location: ".$clientRootDir."members/".$username."/".$portName.".php");
		}
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
									<?php 
									if(isset($errors)) {
										echo "<span class='errMsg'>*$errors</span>";
									}
									?>
								</p>
								<p>
									<label>Description: (optional)</label> <br><br>
									<textarea cols="60" rows="5" name="portDescription" placeholder="What type of portfolio will this be?"></textarea>
								</p>
								<p>
								<label>Portfolio Visibility:</label> <br><br>
										<input type="radio" name="visibility" value="public" checked="checked">
										Public <br>
										<input type="radio" name="visibility" value="private">
										Private
								</p>
								<p>
									<label>Initialize portfolio with new project: </label>
									<input type="checkbox" name="newProject" id="newProjectCheck" value="newProject" >
								</p>
								<span id="newProj">
								</span>
								<br>
								<input type="submit" id="portSubmit" name="submit" value="Create Portfolio">
							</div>
						</fieldset>
					</form>
			</div> <!--End col2-->
			<?php include "include/col3_footer.php"; ?>