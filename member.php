<?php include '../../include/header.php'; ?>
<!-- Put any page-specific head elements here -->
<link rel="stylesheet" type="text/css" media="all" href="../../css/members.css">
<style>
	#newProj {
		margin: auto;
		width: 75%;
		background: #C4D9FF;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
		border-radius: 6px;
		border-left: 2px solid #698BC9;
		border-right: 2px solid #698BC9;
	}
	a:link #newProj, a:visited #newProj {
	background: #A6BFED; 
}
	a:hover #newProj, a:active #newProj {
	background: #C4D9FF;
}
	#currentPorts {
		list-style-type: square;
	}
</style>
</head>
<?php include '../../include/nav.php'; ?>
		<div id="pageContent">
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<span class="outsideShadow"><h1>Members Page: <?php echo "$username"; ?></h1></span>
				<?php
					//Connect to database
					include '../../include/db_connect.php';
					mysqli_select_db($dbHandle, "wip") or die(mysqli_error());
					//Check cookies for login info
					if(isset($_COOKIE['ID_my_site'])) {
						$username = $_COOKIE['ID_my_site'];
						$pass = $_COOKIE['Key_my_site'];
						$check = mysqli_query($dbHandle,"Select * FROM members
											   WHERE username = '".$username."'");
						while($info = mysqli_fetch_array($check)) {
							if ($pass != $info['password']) {
								header("Location: ../../login.php");
							} else { ?>
								<div id="adminArea">
								<a class="noUnder" href="../../newportfolio.php">
									<h3 class="hBold">Create new portfolio</h3>
								</a>
								<h3>List of current portfolios</h3>
								<ul id="currentPorts">
								</ul>
								<h3>List of recent projects</h3>
								<a class="noUnder" href="../../newportfolio.php">
									<h3 class="hBold" id="newProj">Start a new project</h3>
								</a>
								<ol>
									<li>Dynamically-generated list item 1</li>
									<li>Dynamically-generated list item 2</li>
									<li>Dynamically-generated list item 3</li>
								</ol>
								<br> <a id="logoutLink" href=<?php echo $clientRootDir; ?>logout.php>Logout</a>
								</div><!--End Admin Area Div-->
						<?php	}
						}
					} else { //if cookie doesn't exist
						header("Location: ../../login.php");
					}
				?>
			</div> <!--End col2-->
			<script>
					//Onload handler conflicts with onload function used in header.php
					var currentPortsUL = document.getElementById("currentPorts");
					<?php 
						$portResult = getPortList($dbHandle,$username);
						//$row = mysqli_fetch_array($portResult,MYSQLI_NUM);
						while($row = mysqli_fetch_array($portResult,MYSQLI_NUM)) {
							echo "
									var portName = '".$row[0]."';
									var li = document.createElement('li');
									li.innerHTML = portName;
									currentPortsUL.appendChild(li);
								 ";
						}
					?>
			</script>
			<?php include "../../include/col3_footer.php"; ?>