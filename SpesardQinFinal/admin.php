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
				$query2 = "UPDATE users SET banned = 1 WHERE username = '$mybanuser'";
				$result2 = mysqli_query( $conn, $query2);
				header("Refresh:0");
				
			}
			
		}
		
		if(!empty(isset($_POST["unbanuser"]))){
			$myunbanuser = mysqli_real_escape_string( $conn, $_POST[ "unbanuser" ] );
			
			$query4 = "SELECT * FROM users WHERE username = '$myunbanuser'";
			$result4 = mysqli_query( $conn, $query4);
			
			if ( mysqli_num_rows( $result4 ) > 0 ) {
				$query5 = "UPDATE users SET banned = 0 WHERE username = '$myunbanuser'";
				$result5 = mysqli_query( $conn, $query5);
				header("Refresh:0");
				
			}
			
		}
		
		
		if(!empty(isset($_POST["deletePost"]))){
			
			$mydeletePost = mysqli_real_escape_string( $conn, $_POST[ "deletePost" ] );
			echo "$mydeletePost";
			$query3 = "SELECT * FROM posts WHERE id = '$mydeletePost'";
			$result3 = mysqli_query( $conn, $query3);
			
			if(mysqli_num_rows( $result3 ) > 0){
				
				$query6 = "DELETE FROM posts WHERE id = '$mydeletePost'";
				$result6 = mysqli_query($conn, $query6);
				header("Refresh:0");
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
		<label for="banUser">Unban user (Type in only the username): </label>
		<input type="text" name="unbanuser">
	</p>
	
	<p>
		<label for="deletePost">Delete post (Type in only the post id): </label>
		<input type="text" name="deletePost">
	</p>
	
	
	<h3>Users Table: </h3>
	
	<?php
	
		$sql = "SELECT * From users WHERE 1";	
		$result6 = mysqli_query($conn, $sql);
	
	?>
	
		<style>
		table, th, td {
    	border: 1px solid blue;
		} 
		</style>
		
		<table style="width:100%">
  			
  			<?php 
				$bucket = [];
				$count = 0;
				while($rows = mysqli_fetch_assoc($result6)) 
				{
					
					$temp = [$rows["username"], $rows["banned"], $rows["admin"]];
					array_push($bucket, $temp);
					$count++;
				}
			
				$head = ["Username", "Ban", "Admin"];
				
			
			?>
			
			<tr>
   				<?php
					foreach($head as $x){
						?>
    					<th><?php echo $x ?></th>
					<?php } ?>
  			</tr>
   		
    		  			<?php for($i = 0; $i < count($bucket); $i++){
						?>
						<tr>
							<?php for($j = 0; $j < count($bucket[$i]); $j++){
							
							?>
							<th><?php 
							
								if($j < (count($bucket[$i]) - 1)){
								echo $bucket[$i][$j];
								}
								else{
										
									echo $bucket[$i][$j];
								}
								?> </th>
						<?php } ?>
							
						</tr>
						
						
					<?php } ?>		
															
		</table>
		
		
	<h3>Posts Table:</h3>	
	
	
	<?php
	
		$sql2 = "SELECT * From posts WHERE 1";	
		$result7 = mysqli_query($conn, $sql2);
	
	?>
	
		<style>
		table, th, td {
    	border: 1px solid blue;
		} 
		</style>
		
		<table style="width:100%">
  			
  			<?php 
				$bucket2 = [];
				$count2 = 0;
				while($row = mysqli_fetch_assoc($result7)) 
				{
					
					$temp = [$row["id"], $row["date"], $row["title"], $row["author"]];
					array_push($bucket2, $temp);
					$count2++;
				}
			
				$head2 = ["ID", "Date", "Title", "Author"];
				
			
			?>
			
			<tr>
   				<?php
					foreach($head2 as $x){
						?>
    					<th><?php echo $x ?></th>
					<?php } ?>
  			</tr>
   		
    		  			<?php for($i = 0; $i < count($bucket2); $i++){
						?>
						<tr>
							<?php for($j = 0; $j < count($bucket2[$i]); $j++){
							
							?>
							<th><?php 
							
								if($j < (count($bucket2[$i]) - 1)){
								echo $bucket2[$i][$j];
								}
								else{
										
									echo $bucket2[$i][$j];
								}
								?> </th>
						<?php } ?>
							
						</tr>
						
						
					<?php } ?>		
															
		</table>
		
	
	
		
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
