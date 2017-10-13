<html>

<body>

	<h1 style="color:#1CA1A8;"> <img src="search.png" width="33" height="34" alt=""/> MyMessageBoard</h1>

</body>

</html>


<fieldset>

	<legend>Create User Profile</legend>
	<form method="post">
		<div>
			<p>
				<lable for="pic"> Choose a profile picture: </lable>
				<select name="pic">



					<option value="pic1.jpg" data-imagesrc="https://cdn0.iconfinder.com/data/icons/leisure-icons-rounded/110/Magic-Bunny-512.png">bunny</option>

					<option value="pic2.jpg" data-imagesrc="https://image.flaticon.com/icons/svg/29/29662.svg">cat</option>
					<option value="pic3.jpg" data-imagesrc="http://icons.iconarchive.com/icons/martin-berube/flat-animal/256/chicken-icon.png">chicken</option>
					<option value="pic4.jpg" data-imagesrc="https://cdn4.iconfinder.com/data/icons/tail-waggers/120/pug-512.png">dog</option>





				</select>
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
	</form>
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

	$myprofilepic = mysqli_real_escape_string( $conn, $_POST[ "pic" ] );
	$myusername = mysqli_real_escape_string( $conn, $_POST[ "username" ] );
	$mypassword = mysqli_real_escape_string( $conn, $_POST[ "password" ] );
	$myfirstname = mysqli_real_escape_string( $conn, $_POST[ "fname" ] );
	$mylastname = mysqli_real_escape_string( $conn, $_POST[ "lname" ] );
	$myemail = mysqli_real_escape_string( $conn, $_POST[ "email" ] );
	$ban = 0;

	//mysqli_select_db($db, "MessageBoard");
	$sql = "SELECT * FROM users WHERE username = '$myusername'";
	$result = mysqli_query( $conn, $sql );

	if ( mysqli_num_rows( $result ) > 0 ) {

		$error = "Error: THIS USERNAME IS USED.";
		echo $error . "";
	} else {
		// insert user to database
		$sql1 = "INSERT INTO users (fname, lname, username, password, email, banned, picture, admin) VALUES ('$myfirstname', '$mylastname', '$myusername', '$mypassword', '$myemail', '$ban', '$myprofilepic', 0)";

		if ( $conn->query( $sql1 ) == TRUE ) {

			echo "Your account has been generated successfully.<br>";

			setcookie( "username", $myusername );
			//header( "location: homepage.php" );
			header( "location: user_profile.php" );

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