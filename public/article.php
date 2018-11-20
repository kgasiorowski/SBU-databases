<?php

	require_once("../private/php/init.php");
	
	$isFilm;
	
	if(isset($_GET['articleid']) && $_GET['articleid'] != ''){
		
		$articleID = $_GET['articleid'];
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

<h1><?php echo $article['title']?></h1>
<img src="<?php echo IMG_PATH . $article['imageName'] ?>" alt="<?php echo IMG_PATH . IMAGE_NOT_FOUND?>">
<br>
<p><?php echo $article['body']?></p>

<?php 

	// Echo the rest of the person's credits here.
	
	$credits = getCredits($article['personnelID']);
	
	echo '<table id="table_border">';
			
	echo '<tr>';
	echo '<td> Film ID </td><td> Title </td><td> Role </td><td> Genre </td><td> Rating </td>';
	echo '</tr>';
	
	while($row = $credits->fetch(PDO::FETCH_ASSOC)){
		
		echo '<tr>';
		echo "<td>$row[filmID]</td><td>$row[title]</td><td>$row[role]</td><td>$row[genre]</td><td>$row[rating]</td>";
		echo '</tr>';
		
	}
	
	echo '</table>';


?>


<br>
<a href="index.php">Click here to go back.</a>
</body>
</html>

