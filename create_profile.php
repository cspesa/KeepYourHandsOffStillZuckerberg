<html>

<body>

	<h1 style="color:#1CA1A8;"> <img src="../search.png" width="33" height="34" alt=""/> MyMessageBoard</h1>

</body>

</html>


<fieldset>

	<legend>Create User Profile</legend>

	<div>
		<p>
			<lable for="profilepic"> Choose a profile picture: </lable>
			<input type="" name="fileToUpload" id="fileToUpload">
<!--			<input type="submit" value="Upload Image" name="submit3">-->
		</p>
	</div>


	<div>
		<p>
			<label for="name">Username:</label>
			<input type="text" name="username">
		</p>
	</div>

	<p>
		<label for="password">Password:</label>
		<input type="password" name="password">
	</p>

	<p>
		<label for="fname">First Name:</label>
		<input type="text" name="fname">
	</p>
	<p>
		<label for="lname">Last Name:</label>
		<input type="text" name="lname">
	</p>
	<div>
		<p>
			<label for="email">E-mail Address:</label>
			<input type="text" name="email">
		</p>
	</div>

	<div>
		<p>
			<input type="submit" name="submit" value="Submit">
			<input type="submit" name="cancel" value="Cancel">
		</p>
	</div>

</fieldset>

<?php
include( "SQLtools.php" );
$servername = "localhost";
$username = "a290";
$password = "a290php";
$postIDs = [];

$conn = connectSQL( $servername, $username, $password );
if ( !$conn ) {
	die( "Connection failed: " . mysqli_connect_error() );
}

mysqli_select_db( $conn, "MessageBoard" );

// creates new account
if ( isset( $_POST[ "submit" ] ) ) {

	$myusername = mysqli_real_escape_string( $db, $_POST[ "username" ] );
	$mypassword = mysqli_real_escape_string( $db, $_POST[ "password" ] );
	$myfirstname = mysqli_real_escape_string( $db, $_POST[ "fname" ] );
	$mylastname = mysqli_real_escape_string( $db, $_POST[ "lname" ] );
	$myemail = mysqli_real_escape_string( $db, $_POST[ "email" ] );
	$ban = 0;

	//mysqli_select_db($db, "MessageBoard");
	$sql = "SELECT * FROM users where username = '$myusername'";
	$result = mysqli_query( $conn, $sql );

	//$count = 0;

	if ( mysqli_num_rows( $result ) > 0 ) {

		$error = "Error: THIS USERNAME IS USED.";
		echo $error . "";
	} else {
		// insert user to database
		$sql1 = "INSERT INTO users (fname, lname, username, password, email, banned, admin) VALUES ('$myfirstname', '$mylastname', '$myusername', '$mypassword', '$myemail', '$ban', 0)";

		if ( $conn->query( $sql1 ) == TRUE ) {

			echo "Your account has been generated successfully.<br>";

			//$_SESSION[ 'login_user' ] = $myusername;
			setcookie("username", $myusername);
			header( "location: homepage.php" );

		} else {
			echo "Error: " . $sql2 . "<br>" . $conn->error;
		}

	}

	$conn->close();
	

}


if ( isset( $_POST[ "cancel" ] ) ) {

	header( "location: homepage.php" );

}



?>

