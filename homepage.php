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
$result = mysqli_query($conn, $sql);
	

//mysqli_num_rows gets the number of rows in a result
if (gettype($result) != "boolean" ) {
    
	    // output data of each row. 
		////mysqli_fetch_assoc below returns an associative array that corresponds to the fetched row or NULL if there are no more rows.
	$bucket = [];
	$count = 0;
	while($row = mysqli_fetch_assoc($result)) 
	{
		array_push($postIDs, $row["id"]);
		$date = $row["date"];
		$date = substr($date,0,2) . "/" . substr($date,2,2) . "/" .substr($date,4,2);
		$temp =  [$date,$row["rating"],$row["title"],$row["author"],$row["id"]];
		//print_r($temp);
		array_push($bucket, $temp);
       // array_push($bucket,[$row["date"],$row["rating"],$row["title"],$author["author"]]);
		$count++;
    }

	$head = ["Date", "Rating", "Title", "Author", "Comments"];
	make_tableButtons($head, $bucket);
	
	for($i = 0; $i < count($postIDs); $i++){
	if(isset($_POST[$postIDs[$i]])){
		echo $postIDs[$i] . " clicked";
		
	}
	}
	
}
	
	
	
	
	mysqli_close($conn);
?>
</form>
</body>
</html>