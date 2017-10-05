<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php
	
	function connectSQL($servername, $username, $password){
		return mysqli_connect($servername, $username, $password);
	}
	
	
	function cleanMe($input){
		return trim(trim(trim(trim(strip_tags($input), "\""),"_"), " "),"-");
	}
	
	function saveRecord($fname, $lname, $number, $conn){
		
	$sql = "INSERT INTO book (fname, lname, number)
			VALUES (". "\"$fname\"".",". "\"$lname\"".", ".$number.")";
		
	if (mysqli_query($conn, $sql)) {
    	echo "New record added!";
	} else {
    echo "Error: Your record could not be added at this time, please try again later";
		return false;
	}
	return true;
	}
	
	function make_tableButtons($header, $rows){
	
		?>
		<style>
		table, th, td {
    	border: 1px solid blue;
		}
		</style>
		<table style="width:100%">
  			<tr>
   				<?php
					foreach($header as $x){
						?>
    					<th><?php echo $x ?></th>
					<?php } ?>
  			</tr>
  			<?php for($i = 0; $i < count($rows); $i++){
						?>
						<tr>
							<?php for($j = 0; $j < count($rows[$i]); $j++){
							
							?>
							<th><?php if($j != (count($rows[$i]) - 1)){
								echo $rows[$i][$j];
							}
								else{
									//echo $rows[$i][$j];
								?><input type = "submit" name = "<?php echo $rows[$i][$j]?>" value="view"><?php
								}
								
								?> </th>
						<?php } ?>
							
						</tr>
						
						
					<?php } ?>
						
		</table>
		
		<?php
		
	}
	
	function searchPopulateTable($conn, $sql){
		$postIDs = [];
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
	
	}
		return $postIDs;
	}
	
	
	?>


<body>
</body>
</html>