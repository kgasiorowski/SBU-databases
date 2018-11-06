
<?php require_once("../private/php/init.php"); ?>

<?php 

	if(isset($db) && !is_null($db)){
		
		echo '(Init succcessful)';
		br();
		br();
		
	}

?>

<html>
<head>
	<title>
	Imdb clone
	</title>
</head>
<body>

	<h1>Welcome to imdbc, the most popular imdb clone</h1>
	<h2>Main page</h2>
	
	<?php 
	
	$results = $db->query('SELECT title, genre FROM film')->fetchAll();
	
	foreach($results as $result){
		
		foreach($result as $key => $value){
			
			echo "$key => $value".'<br>';
			
		}
		
		br();
		
	}
	
	?>
	
</body>   
</html>