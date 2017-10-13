<?php
//setcookie("username", $myusername, time() + 3600);
if ( !isset( $_COOKIE[ "username" ] ) ) {
	echo '<script language="javascript">';
	echo 'alert("Please log in first!")';
	echo '</script>';

	header( "location: login.php" );

} else {
	
	include( "SQLtools.php" );
	$servername = "localhost";
	$username = "a290";
	$password = "a290php";

	$conn = connectSQL( $servername, $username, $password );
	if ( !$conn ) {
		die( "Connection failed: " . mysqli_connect_error() );
	}
	
	$myusername = $_COOKIE[ "username" ];


	mysqli_select_db( $conn, "MessageBoard" );

	$sql = "SELECT * From users WHERE username = '$myusername'";
	$result = mysqli_query($conn, $sql);
	
	$arr = [];
	$count = 0;
	while($rows = mysqli_fetch_assoc($result)){
		
		$arr = [$rows["fname"], $rows["lname"], $rows["username"], $rows["password"], $rows["email"], $rows["banned"], $rows["picture"], $rows["admin"]];
		
	}
	
	$myfname = $arr[0];
	$mylname = $arr[1];
	$myuser = $arr[2];
	$mypassword = $arr[3];
	$myemail = $arr[4];
	$myban = $arr[5];
	$mypicture = $arr[6];
	$myadmin = $arr[7];


	if ( isset( $_POST[ "submit" ] ) ) {

		if ( !empty( $_POST[ "password" ] ) ) {

			$newpassword = mysqli_real_escape_string( $conn, $_POST[ "password" ]);
			$query1 = "SELECT * FROM users WHERE username = '$myusername'";
			$result1 = mysqli_query( $conn, $query1);
			echo $newpassword;
			if ( mysqli_num_rows( $result1 ) > 0 ) {
				$query = "UPDATE users SET password = '$newpassword' WHERE username = '$myusername'";
				$changepassword = mysqli_query($conn, $query);
				header("Refresh:0");
			}
		}



	}
	
	
		if ( isset( $_POST[ "back" ] ) ) {

			header( "location: homepage.php" );

		}
}


?>

<html>

<body>

	<h1 style="color:#1CA1A8;"> <img src="../search.png" width="33" height="34" alt=""/> MyMessageBoard</h1>

</body>

</html>

<form method="post" >
<fieldset>

	<legend>User Profile</legend>



	<p>
		<label for="name">Username:</label>
<!--		<input type="text" name="username" value='$myuser' readonly>-->
	<?php
		echo $myuser;
		?>
	</p>

	<p>
		<label for="fname">First Name:</label>
			<?php
		echo $myfname;
		?>
	</p>
	<p>
		<label for="lname">Last Name:</label>
			<?php
		echo $mylname;
		?>
	</p>

	<p>
		<label for="email">E-mail Address:</label>
			<?php
		echo $myemail;
		?>
	</p>
	
	<p>
		<label for="password">Change password:</label>
		<input type="password" name="password">
		
	</p>

	<div>
		<p>
			<input type="submit" name="submit" value="Change Password">
			<input type="submit" name="back" value="Back to Homepage">
			
			
			<?php
		
			if ( $myadmin != 0 ) {
		?>
			<form method="post" >
			<p>
				<input type="submit" name="admin" value="Go To Admin Page">
			</p>
			</form>

		<?php

		if ( isset( $_POST[ "admin" ] ) ) {

			header( "location: admin.php" );

		}

	}
		
		?>
			
		</p>
		
	</div>

</fieldset>

</form>
