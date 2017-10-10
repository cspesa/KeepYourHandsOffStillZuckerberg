<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form method="post" >

	
<h4>Search Results</h4>	
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

	
	
if(isset($_COOKIE["author"])){	
$sql = "Select * From posts as a WHERE a.author = \"".$_COOKIE["author"]."\" ORDER BY a.rating DESC";
//mysqli_query performs a query against the database.
	$postIDs = searchPopulateTable($conn, $sql);
	if(count($postIDs) == 0){
		echo "Sorry there are no authors by that name, please search a different term";
	}
	for($i = 0; $i < count($postIDs); $i++){
	if(isset($_POST[$postIDs[$i]])){
		echo $postIDs[$i] . " clicked";
		setcookie("postID", $postIDs[$i]);
		header("Location: contentpage.php");
		
	}
	}

}

else if(isset($_COOKIE["title"])){	
$sql = "Select * From posts as a WHERE a.title = \"".$_COOKIE["title"]."\" ORDER BY a.rating DESC";
//mysqli_query performs a query against the database.
	$postIDs = searchPopulateTable($conn, $sql);
	if(count($postIDs) == 0){
		echo "Sorry there are no titles by that name, please search a different term";
	}
	for($i = 0; $i < count($postIDs); $i++){
	if(isset($_POST[$postIDs[$i]])){
		echo $postIDs[$i] . " clicked";
		setcookie("postID", $i);
		
	}
	}

}

else if(isset($_COOKIE["categorie"])){	
$sql = "Select * From posts as a WHERE a.categorie = \"".$_COOKIE["categorie"]."\" ORDER BY a.rating DESC";
//mysqli_query performs a query against the database.
	$postIDs = searchPopulateTable($conn, $sql);
	if(count($postIDs) == 0){
		echo "Sorry there are no categories by that name, please search a different term";
	}
	for($i = 0; $i < count($postIDs); $i++){
	if(isset($_POST[$postIDs[$i]])){
		echo $postIDs[$i] . " clicked";
		setcookie("postID", $i);
		
	}
	}

}

else if(isset($_COOKIE["rating"])){	
$sql = "Select * From posts as a WHERE a.rating = \"".$_COOKIE["rating"]."\" ORDER BY a.rating DESC";
//mysqli_query performs a query against the database.
	$postIDs = searchPopulateTable($conn, $sql);
	if(count($postIDs) == 0){
		echo "Sorry no post has that many ratings, please search a different term";
	}
	for($i = 0; $i < count($postIDs); $i++){
	if(isset($_POST[$postIDs[$i]])){
		echo $postIDs[$i] . " clicked";
		setcookie("postID", $i);
		
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
	
	
?>
	
	
	
</form>

</body>
</html>