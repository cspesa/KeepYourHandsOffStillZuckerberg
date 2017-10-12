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

<h3>Search Posts</h3> 
<input type="text" name = "searchbar">
<select name="searchterm"> 
<option>author</option>
<option>title</option>
<option>categorie</option>
<option>rating</option>
</select>  
 
 <input type = "submit" name = "search" value="Search"> </br>
  <h4> Sort By Categorie:</h4>
	<input type = "submit" name = "articles" value="articles">
	<input type = "submit" name = "food" value="food">
	<input type = "submit" name = "movies" value="movies">
	<input type = "submit" name = "music" value="music">
  <input type = "submit" name = "history" value="history"> </br>
	
	
	<h2>Top Posts</h2>
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
	


$sql = "Select * From (Select * From posts ORDER BY date DESC) as a ORDER BY a.rating DESC";
//mysqli_query performs a query against the database.
	$postIDs = searchPopulateTable($conn, $sql);
	
	for($i = 0; $i < count($postIDs); $i++){
	if(isset($_POST[$postIDs[$i]])){
		echo $postIDs[$i] . " clicked";
		setcookie("postID", $postIDs[$i]);
		header("Location: contentpage.php");
		
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
	if(isset($_POST["articles"])){
		echo "articles" . " clicked";
		setcookie("categorie", "articles");
		header("Location: catpage.php");
		break;
	}
	if(isset($_POST["food"])){
		echo "food" . " clicked";
		setcookie("categorie", "food");
		header("Location: catpage.php");
		break;
	}
	if(isset($_POST["movies"])){
		echo "movies" . " clicked";
		setcookie("categorie", "movies");
		header("Location: catpage.php");
		break;
	}
	if(isset($_POST["music"])){
		echo "music" . " clicked";
		setcookie("categorie", "music");
		header("Location: catpage.php");
		break;
	}
	if(isset($_POST["history"])){
		echo "history" . " clicked";
		setcookie("categorie", "history");
		header("Location: catpage.php");
		break;
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
}
	
	
	
	mysqli_close($conn);
?>
</form>
</body>
</html>