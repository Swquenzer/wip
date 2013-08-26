<?php require 'php/header.php'; ?>
		<div id="spotlight">
			<ul id="mycarousel" class="jcarousel-skin-ie7">
			   <li>
				<div class="spotlightBody">
					<div class="spotlightHeader">
						<h2>Spotlight</h2>
					</div>
					<img src="gfx/green.gif">
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
			<?php require "php/col1.php"; ?>
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
			<?php require "php/col3_footer.php"; ?>