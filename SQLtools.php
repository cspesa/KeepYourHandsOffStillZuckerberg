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
									echo $rows[$i][$j];
								?><input type = "submit" name = "<?php echo $rows[$i][$j]?>" value="viewq"><?php
								}
								
								?> </th>
						<?php } ?>
							
						</tr>
						
						
					<?php } ?>
						
		</table>
		
		<?php
		
	}
	
	
	
	
	?>


<body>
</body>
</html>