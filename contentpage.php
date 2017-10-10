<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form method="post" >


<h3>Search Posts</h3> 
<input type="text" name = "searchbar">
<select name="searchterm"> 
<option>author</option>
<option>title</option>
<option>categorie</option>
<option>rating</option>
</select>  
	<input type = "submit" name = "search" value="Search">	</br>
	<input type = "submit" name = "return" value="Return to Homepage">	

<?php
	if(isset($_COOKIE["postID"])){
	$id = (int)$_COOKIE["postID"];
	include("SQLtools.php");
	$servername = "localhost";
	$username = "a290";
	$password = "a290php";	
	$conn = connectSQL($servername, $username, $password);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());

}
mysqli_select_db($conn, "MessageBoard");
		
	$sql = "SELECT * FROM posts as a WHERE a.id = " .$id.""; 
	//echo $sql . "   "; 
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	//echo $row["title"];
	echo "<h2>".$row["title"]."</h2>";
	echo"<input type = \"submit\" name = \"articles\" value=\"articles\">";
	echo "<p>".$row["content"]."</p>";
	echo "<p style=\"color:red;\"> Posted by: ".$row["author"]."</p>";
	}
	
	?>
	
<?php



	
	
if(isset($_COOKIE["postID"])){	
$sql = "Select * From comments as a WHERE a.pointer = ".$id;
//mysqli_query performs a query against the database.
	$result = mysqli_query($conn, $sql);
	
	$records = [];
	while($row = mysqli_fetch_assoc($result)){
		$date = $date = $row["date"];
		$date = substr($date,0,2) . "/" . substr($date,2,2) . "/" .substr($date,4,2);
		$temp = [$date,$row["content"],$row["author"]];
		//echo $row["author"];
		array_push($records, $temp);
	}
	print_r($records);
	make_table(["Date","Comment","Author"],$records);
	

}

	
if(isset($_POST["search"])){
		//echo "search" .  $_POST["searchbar"];
		//setcookie("search", "", time() - 3600);
		setcookie($_POST["searchterm"], $_POST["searchbar"]);
		//echo $_POST["searchterm"];
		//echo $_COOKIE["author"];
		header("Location: searchresults.php");
		
	}
	
	if(isset($_POST["return"])){
		header("Location: homepage.php");
		
	}
	
	
?>
	
	
	
</form>

</body>
</html>