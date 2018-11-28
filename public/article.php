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
Click <a href="index.php">here</a> to go back to the index.
<br>
<h1><?php echo $articleSet?$article['title']:'No Article Found' ?></h1>
<p>

<?php 

	if($articleSet){ 
		echo $article['body'];
	}else{
		
		$personnelID = isset($_GET['personnelID'])?$_GET['personnelID']:NULL;
		$filmID = isset($_GET['filmID'])?$_GET['filmID']:NULL;
		
		echo 'No article exists for this person/film. ' ;
		echo "<a href='edit.php?personnelID=$personnelID&filmID=$filmID'>Add this article</a>";
	
	}
	
?>

</p>
<img src="<?php echo IMG_PATH . ($articleSet?$article['imageName']:'') ?>" alt="No image found">
<?php 

	// Echo the rest of the person's credits here.
	if($articleSet){
	
		if($isFilm){
		
			echo '<h3>Film stats</h3>';
			// Display all the regular films stuff
			echo '<table id="table_border">';
			
			$film = getFilmInfo($articleID);
			
			foreach($film as $key=>$row){
		
				$key = str_replace("_"," ",ucfirst($key));
		
				echo '<tr>';
				echo '<td>';
				echo "$key";
				echo '</td>';
				echo '<td>';
				echo "$row";
				echo '</td>';
				echo '</tr>';
			
			}
			
			echo '</table>';
		
			$credits = getFilmRoles($article['filmID']);
			echo '<br>';
			echo '<h3>Cast/crew:</h3>';
			
			echo '<table id="table_border">';
					
			echo '<tr>';
			echo '<th> Name </th><th> Role </th><th>Link</th>';
			echo '</tr>';
			
			foreach($credits as $row){
				
				echo '<tr>';
				echo "<td>$row[name]</td><td>$row[role]</td><td><a href='article.php?articleID=".getArticleByPersonnelID($row['personnelID'])."&personnelID=$row[personnelID]'>Link</a></td>";
				echo '</tr>';
				
			}
			
			echo '</table>';
			

		}else{
			
			echo '<h3>Person stats</h3>';
			// Display all the regular films stuff
			echo '<table id="table_border">';
			
			$personnel = getPersonnelInfo($articleID);
			
			foreach($personnel as $key=>$row){
		
				$key = str_replace("_"," ",ucfirst($key));
		
				echo '<tr>';
				echo '<td>';
				echo "$key";
				echo '</td>';
				echo '<td>';
				echo "$row";
				echo '</td>';
				echo '</tr>';
			
			}
			
			echo '</table>';
			
			$credits = getCredits($article['personnelID']);
			echo '<h3> Credits </h3>';
			echo '<table id="table_border">';
					
			echo '<tr>';
			echo '<th> Title </th><th> Role </th><th> Genre </th><th> Rating </td><th> Link </th>';
			echo '</tr>';
			
			foreach($credits as $row){
				
				echo '<tr>';
				echo "<td>$row[title]</td><td>$row[role]</td><td>$row[genre]</td><td>$row[rating]</td>";
				echo '<td>';
				echo "<a href='article.php?articleID=".getArticleByFilmID($row['filmID'])."&filmID=$row[filmID]'>Link</a>";
				echo '</td>';
				echo '</tr>';
				
			}
			
			echo '</table>';
			
		}
	}
?>


<br>
<? if($articleSet) { ?>
Click <a href='edit.php?articleID=<? echo "$articleID"; ?>'>here</a> to edit this article.
<? } ?>
</body>
</html>

