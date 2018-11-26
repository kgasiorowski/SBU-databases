<?php

	require_once("../private/php/init.php");
	
	if(!loggedIn()){
		
		header('Location: ./login.php');
		
	}
	
	$articleID = isset($_GET['articleID'])?$_GET['articleID']:'';
	$article = getArticle($articleID);
	
?>
<html>
<head>
	<title>Imdb clone</title>
	<link rel="stylesheet" type="text/css" href="../private/style/css/style.css"></head>
</head>
<body>
<a href="index.php">Back to index</a>

	<form action="edit.php" id="editform" method="post">
	
		<label for="title">Title:</label>
		<input type="text" name="title" value="<? echo $article['title'] ?>">
		
		<label for="body">Body:</label>
		<textarea name="body" form = 'editform' rows='10' cols='50'><? echo $article['body'] ?></textarea>
		<br>
		<input type='submit' name='submit' value='Update info'/>
	
	</form>

</body>
</html>

