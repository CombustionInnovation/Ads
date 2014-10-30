<?php
	$user = "dan_ads";
	$pass = "a%+K,r9{wS)k";
	$host = "localhost";
	$proj = "dan_ads";
	$link = @mysqli_connect( $host, $user, $pass, $proj) OR die('Could not connect to MySQL: ' . mysqli_connect_error() );
?>
