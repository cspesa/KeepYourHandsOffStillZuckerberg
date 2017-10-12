<?php

	include("SQLtools.php");
	$servername = "localhost";
	$username = "a290";
	$password = "a290php";
	$postIDs = [];
	$conn = connectSQL($servername, $username, $password);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	mysqli_select_db($conn, "MessageBoard");
	
	if(isset($_POST["confirm"])){
	
		if(!empty(isset($_POST["banuser"]))){
			$mybanuser = mysqli_real_escape_string( $conn, $_POST[ "banuser" ] );
			
			$query = "SELECT * FROM users WHERE username = '$mybanuser'";
			$result = mysqli_query( $conn, $query);
			
			if ( mysqli_num_rows( $result ) > 0 ) {
				$query2 = "UPDATE users SET ban = 1 WHERE username = '$mybanuser'";
				$result2 = mysqli_query( $conn, $query2);
				echo '<script language= "javascript">';
				echo 'alert("This user is baned")';
				echo '</script>';
				header("Refresh:0");
				
			} else{
				
				echo "Error: Cannot find this username. Try again.";
			}
			
			
		}
		
		if(!empty(isset($_POST["deletePost"]))){
			
			$mydeletePost = mysqli_real_escape_string( $conn, $_POST[ "deletePost" ] );
			$query3 = "DELETE FROM posts WHERE id = '$mydeletePost'";
			$result3 = mysqli_query( $conn, $query3);
			
			if(mysqli_num_rows( $result ) > 0){
				echo '<script language= "javascript">';
				echo 'alert("This post is deleted")';
				echo '</script>';
				header("Refresh:0");
			}else{
			
				echo "Error: Cannot find this post. Try again.";
				
			
			}
		}
		
		
		mysqli_close($conn);
	}

	if(isset($_POST["cancel"])){
		
		header( "location: homepage.php" );		
		
	}
	
	
?>







<html>
<body>
<form method="post" >
	<h1 style="color:#1CA1A8;"> <img src="../search.png" width="33" height="34" alt=""/> MyMessageBoard</h1>



<fieldset>

	<legend>Admin Page</legend>

	<p>
		<label for="banUser">Ban user (Type in only the username): </label>
		<input type="text" name="banuser">
	</p>
	
	
	<p>
		<label for="deletePost">Delete post (Type in only the post id): </label>
		<input type="text" name="deletePost">
	</p>
	
	
	
	<?php
	
		//*************optional : list users as a table
		//mysqli_select_db($conn, "MessageBoard");
		$sql = "SELECT username From users";
		print "<table> \n";
	
		$result = mysqli_query($conn, $sql);

//		$row = $result->fetch_assoc();
//		print "<tr> \n";
//		foreach($row as $field => $value){
//			print "<th>$field</th> \n";
//		}
//		
//		print "</tr> \n";
//	
//		//$data = $conn->query($sql);
//		$data = mysql_query($conn, $sql);
//		$data->setFetchMode(PDO::FETCH_ASSOC);
//		foreach($data as $row){
//			print "<tr> \n";
//			foreach ($row as $name=>$value){
//				print " <td>$value</td> \n";
//				
//			}
//			print "</tr> \n";	
//		}
	?>

	<div>
		<p>
			<input type="submit" name="confirm" value="Confirm">
			<input type="submit" name="cancel" value="Cancel">
		</p>
	</div>
</fieldset>
</form>
</body>

</html>
