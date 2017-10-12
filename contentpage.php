<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>


<body>
<form method="post" >
<h1 style="color:#1CA1A8;"> <img src="search.png" width="33" height="34"> MyMessageBoard</h1>

<?php if(isset($_COOKIE["username"])){
	
	echo "<h3 style=\"color: green;\"> ".$_COOKIE["username"]." is logged in </h3>";
	echo "<input type = \"submit\" name = \"profile\" value=\"Profile\">";
	echo "<input type = \"submit\" name = \"logout\" value=\"Logout\">";
	
}
	else {
		
	echo "<input type = \"submit\" name = \"login\" value=\"Login\"></br>";	
		
	}
	
	?>

<fieldset>

<legend>Search Posts</legend> 
<input type="text" name = "searchbar">
<select name="searchterm"> 
<option>author</option>
<option>title</option>
<option>categorie</option>
<option>rating</option>
</select>  
	<input type = "submit" name = "search" value="Search">	</br>
	<input type = "submit" name = "return" value="Return to Homepage">	</br>
<style>
</style>
</fieldset>

<fieldset>
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

	$rating = (int)$row["rating"];
	if($rating > 0){
		$rColor = "Green";
		
	}
	else{
		$rColor = "Red";
	}
	echo "<legend><h2>".$row["title"]."</h2></legend>";
	echo "<p>".$row["content"]."</p>";
	echo "<p style=\"color:blue;\"> Posted by: ".$row["author"]."</p>";
	echo "<h2 style= \"color:".$rColor.";\">".$rating." people like this post</h2>";
	echo"<input type = \"submit\" name = \"upvote\" style= \"color:green;\" value=\"Upvote\">";
	echo"<input type = \"submit\" name = \"downvote\" style= \"color:red;\" value=\"Downvote\">";
	
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
	//print_r($records);
	make_table(["Date","Comment","Author"],$records);
	

	

}

	
if(isset($_COOKIE["username"])){
		?>
	
	</br>
	<textarea rows=2 name ="comment" size=50></textarea>
	<input type="submit" name="submitcomment" value="comment">
	
	
	<?php
	
	if(isset($_POST["upvote"])){
		$sql = "UPDATE posts SET rating = ". (1 + (int)$rating) . " WHERE id = ".$id ;
		$result = mysqli_query($conn, $sql);
		header("Location: contentpage.php");
		echo $sql;
	}
	else if(isset($_POST["downvote"])){
		$sql = "UPDATE posts SET rating = ". ((int)$rating - 1) . " WHERE id = ".$id ;
		$result = mysqli_query($conn, $sql);
		header("Location: contentpage.php");
		echo "downvoted";
	}
	
	
}
else{
	echo "Login to comment and rate";
}
	
if(isset($_POST["submitcomment"])){
	$date = date("m d y");
	$date = (int)str_replace(" ", "",$date);
	$sql = "INSERT INTO comments (`pointer`, `date`, `content`, `author`) VALUES (".$id.",".$date.",\"".$_POST["comment"]."\",\"".$_COOKIE["username"]."\")";
	$result = mysqli_query($conn, $sql);
	header("Location: contentpage.php");
	echo $sql;
	
	
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
	
if(isset($_POST["login"])){
	header("Location: login.php");
}

if(isset($_POST["logout"])){
	echo "tried to logout";
	setcookie("username","",time()-3600);
	header("Location: contentpage.php");
}

if(isset($_POST["profile"])){
	header("Location: user_profile.php");
}
	
	
?>
	
</fieldset>
	
</form>

</body>
</html>