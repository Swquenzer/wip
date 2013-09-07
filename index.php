<?php include 'php/header.php'; ?>
<!-- Put any page-specific head elements here -->
<!--custom index css-->
	<style type="text/css">
	   #colMain {margin-top: 0;}
	 </style>
	 <!--Get resources for carousel-->
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="css/carousel/skin.css">
	<link rel="stylesheet" type="text/css" media="all" href="css/index.css">
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery("#mycarousel").jcarousel({
				
			});
		});
	</script>
</head>
<?php include 'php/nav.php'; ?>
		<div id="spotlight">
			<ul id="mycarousel" class="jcarousel-skin-ie7">
			   <li>
				<div class="spotlightBody">
					<div class="spotlightHeader">
						<h2>Spotlight</h2>
					</div>
					<img src="gfx/spot.jpg">
					<p>About my artwork and stuff! About my artwork and stuff! About my artwork and stuff! About my artwork and stuff! About my artwork and stuff! About my artwork and stuff! </p>
				</div>	
					<h3>Featured Artist: <a href="#">Stephen Quenzer</a></h3>
			   </li>
			   <li>
					<div class="spotlightHeader">
					</div>
			   </li>
			   <li>
					<div class="spotlightHeader">
					</div>
			   </li>
			   <li>
					<div class="spotlightHeader">
					</div>
			   </li>
			</ul>
		</div> <!--End spotlight-->
		<div id="pageContent">
			<?php include "php/col1.php"; ?>
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<span id="contentHeader"><h1>Why WIP?</h1></span>
				<p>
					<ol>
						<li><a href="#">Inspiration</a></li>
						<li>Motivation</li>
						<li>Critiques</li>
						<li>Learning</li>
						<li>Portfolio Development</li>
						<li>Etc.</li>
						<li><?php echo $_SERVER['SCRIPT_NAME']; ?></li>
					</ol>
				</p>
			</div> <!--End col2-->
			<?php include "php/col3_footer.php"; ?>