<?php require '../../include/header.php'; ?>
<!-- Put any page-specific head elements here -->
<?php 
	$portURLName = basename($_SERVER['PHP_SELF'],".php");
	$portInfo = getPortInfo($dbHandle, $username, $portURLName);
	$portName = $portInfo['name'];
	$portDescription = $portInfo['description'];
	$portCreateDate = $portInfo['creation_date'];
	$portVisibility = $portInfo['public']; #1 for public, 0 for private
 ?>
</head>
<?php include '../../include/nav.php'; ?>
		<div id="pageContent">
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<span class="outsideShadow"><h1>Portfolio: <?php echo "$portName"; ?></h1></span>
				<ul>
					<?php
						echo "<li>Portfolio Name: ".$portName."</li>";
						echo "<li>Portfolio Description: ".$portDescription."</li>";
						echo "<li>Portfolio Creation: ".$portCreateDate."</li>";
						echo "<li>Portfolio Visibility : ".$portVisibility."</li>";
					?>
				</ul>
			</div> <!--End col2-->
			<?php include "../../include/col3_footer.php"; ?>