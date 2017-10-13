<html>

<body>

	<h1 style="color:#1CA1A8;"> <img src="search.png" width="33" height="34" alt=""/> MyMessageBoard</h1>

</body>

</html>

<?php
include( "config.php" );
session_start();

if ( isset( $_POST[ "submit" ] ) ) {

	$myusername = mysqli_real_escape_string( $db, $_POST[ "username" ] );
	$mypassword = mysqli_real_escape_string( $db, $_POST[ "password" ] );

	mysqli_select_db( $db, "MessageBoard" );
	$sql = "SELECT * FROM users";
	$result = mysqli_query( $db, $sql );


	if ( $result || mysqli_num_rows( $result ) != 0 ) {

		while ( $row = mysqli_fetch_assoc( $result ) ) {

			if ( $row[ "username" ] == $myusername and $row[ "password" ] == $mypassword ) {

				setcookie( "username", $myusername, time() + 3600 );
				$conn->close();
				header( "location: homepage.php" );

			} else {
				$error = "Your Login Name or Password is invalid";

			}


		}

	}

} else if ( isset( $_POST[ "register" ] ) ) {

	header( "location:create_profile.php" );

}
?>
<html>

<head>
	<title>Login Page</title>

	<style type="text/css">
		body {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
		}
		
		label {
			font-weight: bold;
			width: 100px;
			font-size: 14px;
		}
		
		.box {
			border: #666666 solid 1px;
		}
	</style>

</head>

<body bgcolor="#FFFFFF">

	<div align="center">
		<div style="width:300px; border: solid 1px #333333; " align="left">
			<div style="background-color:#1CA1A8; color:#FFFFFF; padding:3px;"><b>Login</b>
			</div>

			<div style="margin:30px">

				<form action="" method="post">
					<label>UserName  :</label><input type="text" name="username" class="box"/><br/><br/>
					<label>Password  :</label><input type="password" name="password" class="box"/><br/><br/>
					<div>
						<p>
							<input type="submit" name="submit" value=" Submit "/><br/>
						</p>
						<p>
							<input type="submit" name="register" value=" Register "/><br/>
						</p>
					</div>
				</form>

			</div>

		</div>

	</div>

</body>

</html>