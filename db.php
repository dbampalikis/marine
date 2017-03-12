<?php
	$hostname = "localhost";
	$username = "root";
	$password = "LIMS.2017.Uppsala";
	$database = "Marine";
	$conn = new mysqli($hostname, $username, $password, $database)
	or die("Could not open connection to database");
?>
