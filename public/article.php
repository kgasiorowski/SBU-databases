<?php

	require_once("../private/php/init.php");
	
	$isFilm;
	
	$articleSet = isset($_GET['articleID']) && $_GET['articleID'] != '';
	
	if($articleSet){
		
		$articleID = $_GET['articleID'];
		$article = getArticle($articleID);
		$isFilm = $article['isFilm'];
		
	}
	
?>
<html>
<head>
	<title>Imdb clone</title>
	<link rel="stylesheet" type="text/css" href="../private/style/css/style.css"></head>
</head>
<body>

<h1><?php echo $articleSet?$article['title']:'No Article Found' ?></h1>
<img src="<?php echo IMG_PATH . ($articleSet?$article['imageName']:'') ?>" alt="No image found">
<br>
<p><?php echo $articleSet?$article['body']:'No article was found for that person/film. Add an article' ?></p>

<?php 

	// Echo the rest of the person's credits here.
	if($articleSet){
	
		if($isFilm){
		
			$credits = getFilmRoles($article['filmID']);
			
			echo '<table id="table_border">';
					
			echo '<tr>';
			echo '<th> Personnel ID </th><th> Role </th><th> Name </th>';
			echo '</tr>';
			
			while($row = $credits->fetch(PDO::FETCH_ASSOC)){
				
				echo '<tr>';
				echo "<td><a href='article.php?articleID=".getArticleIDByPersonnelID($row['personnelID'])."'>$row[personnelID]</a></td><td>$row[role]</td><td>$row[name]</td>";
				echo '</tr>';
				
			}
			
			echo '</table>';
			

		}else{
			
			$credits = getCredits($article['personnelID']);
			
			echo '<table id="table_border">';
					
			echo '<tr>';
			echo '<th> Film ID </th><th> Title </th><th> Role </th><th> Genre </th><th> Rating </td>';
			echo '</tr>';
			
			while($row = $credits->fetch(PDO::FETCH_ASSOC)){
				
				echo '<tr>';
				echo '<td>';
				echo "<a href='article.php?articleID=".getArticleIDByFilmID($row['filmID'])."'>$row[filmID]</a>";
				echo '</td>';
				echo "<td>$row[title]</td><td>$row[role]</td><td>$row[genre]</td><td>$row[rating]</td>";
				echo '</tr>';
				
			}
			
			echo '</table>';
			
		}
	}
?>


<br>
<a href="index.php">Click here to go back.</a>
</body>
</html>

