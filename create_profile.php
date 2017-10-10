<html>

<body>

	<h1 style="color:#1CA1A8;"> <img src="../search.png" width="33" height="34" alt=""/> MyMessageBoard</h1>

</body>

</html>


<fieldset>

	<legend>Create User Profile</legend>

	<div>
		<p>
			<lable for="profilepic"> Upload a profile picture: </lable>
			<input type="file" name="fileToUpload" id="fileToUpload">
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

			$_SESSION[ 'login_user' ] = $myusername;
			header( "location: homepage.php" );

		} else {
			echo "Error: " . $sql2 . "<br>" . $conn->error;
		}

	}

	$conn->close();

//	$file = rand( 1000, 100000 ) . "-" . $_FILES[ 'file' ][ 'name' ];
//	$file_loc = $_FILES[ 'file' ][ 'tmp_name' ];
//	$file_size = $_FILES[ 'file' ][ 'size' ];
//	$file_type = $_FILES[ 'file' ][ 'type' ];
//	$folder = "uploads/";
//
//	move_uploaded_file( $file_loc, $folder . $file );
//	$sql = "INSERT INTO tbl_uploads(file,type,size) VALUES('$file','$file_type','$file_size')";
//	mysql_query( $sql );
	
	
	
	//************* upload pics
$target_dir = "uploads/";
	$target_file = $target_dir . basename( $_FILES[ "fileToUpload" ][ "name" ] );
	$uploadOk = 1;
	$imageFileType = pathinfo( $target_file, PATHINFO_EXTENSION );	


// Check if image file is a actual image 
	
	$check = getimagesize( $_FILES[ "fileToUpload" ][ "tmp_name" ] );
	if ( $check !== false ) {
		echo "File is an image - " . $check[ "mime" ] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}

// Check if file already exists
if ( file_exists( $target_file ) ) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
}
// Check file size
if ( $_FILES[ "fileToUpload" ][ "size" ] > 500000 ) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
}
// Allow certain file formats
if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" &&
	$imageFileType != "gif" ) {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ( $uploadOk == 0 ) {
	echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
} else {
	if ( move_uploaded_file( $_FILES[ "fileToUpload" ][ "tmp_name" ], $target_file ) ) {
		echo "The file " . basename( $_FILES[ "fileToUpload" ][ "name" ] ) . " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}



//******************
	
	

}


if ( isset( $_POST[ "cancel" ] ) ) {

	header( "location: homepage.php" );

}








?>

