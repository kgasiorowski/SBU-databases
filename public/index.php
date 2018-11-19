
<?php require_once("../private/php/init.php"); ?>

<?php 

	$submitted = $_SERVER['REQUEST_METHOD'] == 'POST';

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
	
	<?php 
	
		if($submitted){
			
			$filter = isset($_POST['filter']) ? $_POST['filter'] : null;
			$searchText = isset($_POST['searchText']) && $_POST['searchText'] != '' ? $_POST['searchText'] : null;
			
			$query = 'SELECT * FROM articlev WHERE ';
				
			if($filter == 'personnel')
				$query .= 'isFilm = 0 AND ';
			else if($filter == 'films')
				$query .= 'isFilm = 1 AND ';
			
			$query .= 'body LIKE \'%'.$searchText.'%\';';
			
			/*
			br();
			echo $query;
			br();
			*/
			
			$results = $db->query($query);

			echo '<table id="table_border">';
			
			echo '<tr>';
			echo '<td> Article ID </td><td> Title </td><td> Body </td><td> Author Username </td><td> Author Full Name </td>';
			echo '</tr>';
			
			while($row = $results->fetch(PDO::FETCH_ASSOC)){
				
				echo '<tr>';
				echo "<td>$row[articleID]</td><td>$row[title]</td><td>$row[body]</td><td>$row[author]</td><td>$row[fullname]</td>";
				echo '</tr>';
				
			}
			
			echo '</table>';
			
			br();
			
		}
	
	?>
	
	<form action="./index.php" id="filterForm" method="post">
	
		Limit search to: 
		
		<select name="filter" form="filterForm">
		
			<option value="both">Both</option>
			<option value="personnel">Personnel</option>
			<option value="films">Films</option>
			
		</select><br>
		
		Search for: <input type="text" name="searchText" value=""><br><br>
		
		<input type="submit" value="Search">
	
	</form>
	
</body>   
</html>