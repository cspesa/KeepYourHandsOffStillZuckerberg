<?php
	// config: 
	$servername = "localhost";
	$username = "a290";
	$password = "a290php";
	$dbname = "MessageBoard";

	$db = mysqli_connect( $servername, $username, $password );
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ( !$db || $conn->connect_error) {
		die( "Connection failed: " . mysqli_connect_error() );
	}

	
?>