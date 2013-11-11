<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "kingku610";
$dbName = "wip";
#Connect to database
$dbHandle = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
//Check connection
if ($dbHandle->connect_errno) {
	printf("Connection to database failed: %s\n", $dbHandle->connect_error);
	exit();
}
?>