<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<form method="post" >

<h1 style="color:#1CA1A8;"> <img src="search.png" width="33" height="34"> MyMessageBoard</h1>
<h3>Search Posts</h3> 
<input type="text" name = "searchbar"> <input type = "submit" name = "search" value="Search"> </br>
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
		
	}
	}
	
if(isset($_Post["movies"])){
	$sql = "Select * From posts WHERE categorie = \"movie\"";
	$postIDs = searchPopulateTable($conn, $sql);
}
	

	for($i = 0; $i < count($postIDs); $i++){
	if(isset($_POST[$postIDs[$i]])){
		echo $postIDs[$i] . " clicked";
		
	}
	}
	
	
	
	mysqli_close($conn);
?>
</form>
</body>
</html>