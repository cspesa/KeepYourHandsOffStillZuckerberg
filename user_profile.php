<html>

<body>

	<h1 style="color:#1CA1A8;"> <img src="../search.png" width="33" height="34" alt=""/> MyMessageBoard</h1>

</body>

</html>


<fieldset>

	<legend>User Profile</legend>



	<div>
		<p>
			<label for="name">Username:</label>
			<input type="text" name="username" value='$user' readonly>
		</p>
	</div>

	<p>
		<label for="password">Change password:</label>
		<input type="password" name="password">
	</p>

	<p>
		<label for="fname">First Name:</label>
		<input type="text" name="fname" value = '$firstname' readonly>
	</p>
	<p>
		<label for="lname">Last Name:</label>
		<input type="text" name="lname" value='$lastname' readonly>
	</p>
	<div>
		<p>
			<label for="email">E-mail Address:</label>
			<input type="text" name="email" value='$email' readonly>
		</p>
	</div>

	<div>
		<p>
			<input type="submit" name="submit" value="Submit">
		</p>
	</div>

</fieldset>



<?php
$_SESSION[ 'login_user' ] = $myusername;

include("SQLtools.php");
$servername = "localhost";
$username = "a290";
$password = "a290php";
$conn = connectSQL($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_select_db($conn, "MessageBoard");
$myfname = "SELECT fname FROM users WHERE username = '$myusername'";
$mylname = "SELECT lname FROM users WHERE username = '$myusername'";
$myusername = "SELECT username FROM users WHERE username = '$myusername'";
$mypassword = "SELECT password FROM users WHERE username = '$myusername'";
$myemail = "SELECT email FROM users WHERE username = '$myusername'";
$mypicture = "SELECT picture FROM users WHERE username = '$myusername'";

//mysqli_query performs a query against the database.
$firstname = mysqli_query($conn, $myfname);
$lastname = mysqli_query($conn, $mylname);
$user = mysqli_query($conn, $myusername);
$pwd = mysqli_query($conn, $mypassword);
$email = mysqli_query($conn, $myemail);
$pic = mysqli_query($conn, $mypicture);

if ( isset( $_POST[ "submit" ] ) ) {
	
	if (!empty($_POST["password"])) {
		
		$newpassword = $_POST["password"];
		$mynewpassword = "UPDATE users SET password = $newpassword WHERE username = '$myusername'";

	}
	
	header( "location: homepage.php" );
	
}


?>
