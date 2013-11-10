<?php include '../../include/header.php'; ?>
<!-- Put any page-specific head elements here -->
<?php 
	$portURLName = basename($_SERVER['PHP_SELF'],".php");
	$portInfo = getPortInfo($dbHandle, $username, $portURLName);
	$portName = $portInfo[2];
	$portDescription = $portInfo[3];
	$portCreateDate = $portInfo[4];
	$portVisibility = $portInfo[5]; #0 for public, 1 for private
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