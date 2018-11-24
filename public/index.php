
<?php 

	require_once("../private/php/init.php"); 

	$submitted = $_SERVER['REQUEST_METHOD'] == 'POST';
	$loggedin = isset($_SESSION['uid']) && isset($_SESSION['username']);
	
	if($submitted){
		$filter = isset($_POST['filter']) ? $_POST['filter'] : null;
		$searchText = isset($_POST['searchText']) && $_POST['searchText'] != '' ? $_POST['searchText'] : null;
	}
	
?>

<html>
<head>
	<title>Imdb clone</title>
	<link rel="stylesheet" type="text/css" href="../private/style/css/style.css"></head>
</head>
<body>

	<?php 
	
		if($loggedin){
	
			echo 'Logged in as \''.$_SESSION['username'].'\' (<a href=\'login.php?logout\'>logout</a> here)';
		
		}else{
			
			echo 'Not logged in<br>';
			echo 'Log in <a href=\'login.php\'>here</a><br>';
			echo 'Or create an account <a href=\'createAccount.php\'>here</a>';
			
		}
	
	?>
	
	<h1>Welcome to IMDBc, the most popular IMDB clone</h1>
	
	<img src="<? echo IMG_PATH?>imdbc_icon.png">
	
	<h2>Main page</h2>
	
	<h3>Filter the database:</h3>
	
	<form action="./index.php" id="filterForm" method="post">
	
		Limit search to: 
		
		<select name="filter" form="filterForm">
		
			<option value="both" <? 
			echo isset($filter) && $filter == 'both'? 'selected':'';
			?>>Both</option>
			
			<option value="personnel" <? 
			echo isset($filter) && $filter == 'personnel'? 'selected':'';
			?>>Personnel</option>
			
			<option value="films" <?
			echo isset($filter) && $filter == 'films'? 'selected':'';
			?>>Films</option>
			
		</select><br>
		
		Search for: <input type="text" name="searchText" value="<? echo $submitted?$searchText:'' ?>"><br><br>
		
		<?php 
	
		if($submitted){
			
			$results = filterDB($searchText, $filter);

			if($results && $results->rowCount() != 0)
			{
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
				
			}else{
				
				
				echo 'No results found for search string \''.$searchText.'\'';
				br();
				
			}
			
			br();
			
		}
	
		?>
		
		<input type="submit" value="Search">
	
	</form>
	
</body>   
</html>