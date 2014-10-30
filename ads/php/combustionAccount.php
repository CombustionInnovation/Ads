<?php
	$user = "cbi_masteracct";
	$pass = "w3lc0me!";
	$host = "localhost";
	$proj = "cbi_combustion";
	$link = @mysqli_connect($host, $user, $pass, $proj) OR die('Could not connect to MySQL: ' . mysqli_connect_error() );
?>