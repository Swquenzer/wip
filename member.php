<?php include '../../include/header.php'; ?>
<!-- Put any page-specific head elements here -->
<link rel="stylesheet" type="text/css" media="all" href="../../css/members.css">
</head>
<?php include '../../include/nav.php'; ?>
		<div id="pageContent">
			<div id="colMain"> <!-- ### MAIN CONTENT ### -->
				<h1>Members Page: <?php echo "$username"; ?></h1>
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
								<h2>Admin Area</h2> 
								<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec tortor leo. In eu eros ac massa convallis consectetur id ut lorem. Integer dictum molestie eros quis rutrum. Curabitur eu massa est, et semper elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse consequat massa nec felis pharetra semper. Curabitur ut eros non lorem laoreet hendrerit sit amet id arcu.
								</p>
								<p>
								Pellentesque gravida malesuada leo accumsan varius. Fusce accumsan facilisis augue, sit amet laoreet libero egestas at. Morbi gravida sapien vitae ipsum aliquet laoreet. Aliquam eros purus, rutrum auctor mollis sit amet, laoreet et nibh. Fusce commodo, est sit amet ultricies suscipit, ligula metus sagittis risus, et blandit tortor justo et justo. Cras nisl risus, pharetra ut mattis sed, pulvinar id metus. Praesent tortor quam, faucibus et posuere nec, cursus in dui. Nulla urna nisi, cursus quis luctus vitae, condimentum sed turpis.
								</p>
								<p>
								Cras tempor, lectus id euismod semper, justo ligula semper massa, eu commodo orci nibh a velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed eget arcu mauris, mollis venenatis nibh. In hac habitasse platea dictumst. Donec et purus mauris. Curabitur pharetra, eros id imperdiet varius, magna tellus mollis odio, in congue nisl lectus vitae justo. Nullam neque quam, pretium nec euismod sit amet, consequat vel urna. Nullam venenatis adipiscing blandit. Proin at urna eu arcu viverra accumsan. Aliquam erat volutpat. 
								</p>
								<br> <a id="logoutLink" href=<?php echo $clientRootDir; ?>logout.php>Logout</a>
								</div><!--End Admin Area Div-->
						<?php	}
						}
					} else { //if cookie doesn't exist
						header("Location: ../../login.php");
					}
				?>
			</div> <!--End col2-->
			<?php include "../../include/col3_footer.php"; ?>