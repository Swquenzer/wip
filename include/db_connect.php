<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "kingku610";
#Connect to database
$dbHandle = mysqli_connect($dbHost,$dbUser,$dbPass)
			or die("Error connecting to SQL Server on $dbHost");
?>