
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
			
			$filmQuery = '
			
			SELECT 
				article.ID AS articleID, 
				user.username AS author,
				CONCAT(user.firstname, \' \', user.lastname) AS fullname, 
				article.title AS articletitle, 
				article.body AS articlebody 
			FROM 
				article 
			INNER JOIN
				user ON user.ID = original_author_id
			INNER JOIN 
				film ON film.ID = filmID
			WHERE 
				article.title LIKE "%'.$searchText.'%" 
				OR 
				article.body LIKE "%'.$searchText.'%" 
						
			';
			
			$personnelQuery = '
			
			SELECT 
				article.ID AS articleID, 
				user.username AS author,
				CONCAT(user.firstname, \' \', user.lastname) AS fullname, 
				article.title AS articletitle, 
				article.body AS articlebody 
			FROM 
				article 
			INNER JOIN
				user ON user.ID = original_author_id
			INNER JOIN 
				personnel on personnel.id = personnelID
			WHERE 
				article.title LIKE "%'.$searchText.'%" 
				OR 
				article.body LIKE "%'.$searchText.'%"
			';
			
			$query = '';
			
			if($filter == 'both')
				$query .= '(' . $filmQuery . ') UNION (' . $personnelQuery . ')';	
			else if($filter == 'personnel')
				$query .= $personnelQuery;
			else if($filter == 'films')
				$query = $filmQuery;
			
			$query .= ';';
			
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
				echo "<td>$row[articleID]</td><td>$row[articletitle]</td><td>$row[articlebody]</td><td>$row[author]</td><td>$row[fullname]</td>";
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