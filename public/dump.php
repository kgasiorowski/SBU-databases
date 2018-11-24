<?php require_once("../private/php/init.php"); 

	global $db;

?>

<html>
<head><link rel="stylesheet" type="text/css" href="../private/style/css/style.css"></head>
<body>
<h1>All tables viewable to the current user</h1>
<?php 

	$query = 'show tables;';
	$result = $db->query($query);
	
	while($row = $result->fetch(PDO::FETCH_ASSOC)['Tables_in_imdbc']){
		
		echo '<details>';
		echo "<summary>$row</summary>";
		
		$query = "SELECT * FROM $row;";
		$innerResult = $db->query($query);
		
		while($innerRow = $innerResult->fetch(PDO::FETCH_ASSOC)){
			
			pr($innerRow);
			
		}
		
		echo '</details>';
		
	}
	
?>

</body>
</html>