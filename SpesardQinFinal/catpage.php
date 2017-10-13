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

<?php
	if(isset($_COOKIE["categorie"])){
		switch($_COOKIE["categorie"]){
		
			case "movies":
				?><h2>Movies</h2><?php
				break;
			case "music":
				?><h2>Music</h2><?php
				break;
			case "food":
				?><h2>Food</h2><?php
				break;
			case "history":
				?><h2>History</h2><?php
				break;
			case "articles":
				?><h2>Articles</h2><?php
				break;
			default:
				?><h4>This shouldn't happen...</h4><?php
				break;
		}
	}
	
	?>
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
include("SQLtools.php");
$servername = "localhost";
$username = "a290";
$password = "a290php";	
$conn = connectSQL($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());

}
mysqli_select_db($conn, "MessageBoard");	

	
	
if(isset($_COOKIE["categorie"])){	
$sql = "Select * From posts as a WHERE a.categorie = \"".$_COOKIE["categorie"]."\" ORDER BY a.rating DESC";
//mysqli_query performs a query against the database.
	$postIDs = searchPopulateTable($conn, $sql);
	if(count($postIDs) == 0){
		echo "Sorry there are no posts in that categorie, please search a different term or select another categorie";
	}
	for($i = 0; $i < count($postIDs); $i++){
	if(isset($_POST[$postIDs[$i]])){
		echo $postIDs[$i] . " clicked";
		setcookie("postID", $postIDs[$i]);
		header("Location: contentpage.php");
		
	}
	}

}

for($i = 0; $i < count($postIDs); $i++){
	if(isset($_POST["search"])){
		//echo "search" .  $_POST["searchbar"];
		//setcookie("search", "", time() - 3600);
		setcookie($_POST["searchterm"], $_POST["searchbar"]);
		//echo $_POST["searchterm"];
		//echo $_COOKIE["author"];
		header("Location: searchresults.php");
		break;
	}
	
	if(isset($_POST["return"])){
		header("Location: homepage.php");
		break;
	}
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
	header("Location: catpage.php");
}

if(isset($_POST["profile"])){
	header("Location: user_profile.php");
}
	
	
?>
	
	
	
</form>

</body>
</html>