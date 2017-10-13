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
	echo "<input type = \"submit\" name = \"logout\" value=\"Logout\"></br>";
	
}
	else {
		
	echo "<input type = \"submit\" name = \"login\" value=\"Login\"></br>";	
		
	}
	
	?>

<input type = "submit" name = "return" value="Return to Homepage">	
<h3>Create Post</h3>

<h4>Title</h4>	
	<input type = "text" name = "title"> </br>	
	
</br>
<h4>Content</h4>	
	<textarea rows=5 name ="content" size=50 width=100></textarea> </br>
	<label>Categorie</label>
	<select name="categorie"> 
	<option>Movies</option>
	<option>Music</option>
	<option>Articles</option>
	<option>Food</option>
	<option>History</option>
	</select>  
	</br>
	<input type="submit" name="submitpost" value="Post">		
<?php
include("SQLtools.php");
$servername = "localhost";
$username = "a290";
$password = "a290php";	
$conn = connectSQL($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());

}
mysqli_select_db($conn, "MessageBoard");	

	
if(isset($_POST["submitpost"])){
	echo "posting";
	
	
	$sql = "SELECT MAX(id) FROM posts";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$newID =  $row["MAX(id)"]+1;
	
	$date = date("m d y");
	$date = (int)str_replace(" ", "",$date);
	
	$cleancontent = cleanme($_POST["content"]);
	
	$sql = "INSERT INTO posts (`id`, `date`,`title`, `content`, `author`,`rating`,`categorie`) VALUES (".$newID.",".$date.",\"".$_POST["title"]."\",\"".$cleancontent."\",\"".$_COOKIE["username"]."\",0,\"".$_POST["categorie"]."\")";
	$result = mysqli_query($conn, $sql);
	echo $sql;
	header("Location: homepage.php");
	
	
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
	header("Location: homepage.php");
}

if(isset($_POST["profile"])){
	header("Location: user_profile.php");
}

	
	
?>
	
	
	
</form>

</body>
</html>