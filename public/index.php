
<?php 

	require_once("../private/php/init.php"); 

	$submitted = $_SERVER['REQUEST_METHOD'] == 'POST';

	if($submitted)
		$filter = isset($_POST['filter']) ? $_POST['filter'] : null;
	
?>

<html>
<head>
	<title>Imdb clone</title>
	<link rel="stylesheet" type="text/css" href="../private/style/css/style.css"></head>
</head>
<body>

	<h1>Welcome to IMDBc, the most popular IMDB clone</h1>
	<h2>Main page</h2>
	
	<h3>Filter the database:</h3>
	
	<form action="./index.php" id="filterForm" method="post">
	
		Limit search to: 
		
		<select name="filter" form="filterForm">
		
			<option value="both" <?php 
			echo isset($filter) && $filter == 'both'? 'selected':'';
			?>>Both</option>
			
			<option value="personnel" <?php 
			echo isset($filter) && $filter == 'personnel'? 'selected':'';
			?>>Personnel</option>
			
			<option value="films" <?php 
			echo isset($filter) && $filter == 'films'? 'selected':'';
			?>>Films</option>
			
		</select><br>
		
		Search for: <input type="text" name="searchText" value=""><br><br>
		
		<input type="submit" value="Search">
	
	</form>
	
	<?php 
	
		if($submitted){
			
			$searchText = isset($_POST['searchText']) && $_POST['searchText'] != '' ? $_POST['searchText'] : null;
			
			$results = filterDB($searchText, $filter);

			echo '<table id="table_border">';
			
			echo '<tr>';
			echo '<th> Article ID </th><th> Title </th><th> Body </th><th> Author Username </th><th> Author Full Name </th>';
			echo '</tr>';
			
			while($row = $results->fetch(PDO::FETCH_ASSOC)){
				
				echo '<tr>';
				echo "<td><a href='article.php?articleID=$row[articleID]'>$row[articleID]</a></td><td>$row[title]</td><td>$row[body]</td><td>$row[author]</td><td>$row[fullname]</td>";
				echo '</tr>';
				
			}
			
			echo '</table>';
			
			br();
			
		}
	
	?>
	
</body>   
</html>