<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "p@ssw0rd";
#Connect to database
$dbHandle = mysqli_connect($dbHost,$dbUser,$dbPass)
			or die("Error connecting to SQL Server on $dbHost");
?>