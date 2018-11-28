<?php

	require_once("../private/php/init.php");
	
	if(!loggedIn()){
		
		header('Location: ./login.php');
		
	}
	
	$uid = $_SESSION['uid'];
	$articleID = isset($_GET['articleID']) && $_GET['articleID'] != '' ? $_GET['articleID'] : null;
	
	$personnelID = isset($_GET['personnelID']) && $_GET['personnelID']?$_GET['personnelID']:null;
	$filmID = isset($_GET['filmID']) && $_GET['filmID']?$_GET['filmID']:null;
	
	pr($personnelID);
	pr($filmID);
	
	if($articleID != null)
		$article = getArticle($articleID);
	else{
		
		$article = null;
		
	}
	
	$submitted = isset($_POST['submit']);
	$error = false;
	
	if($submitted){
			
		// Get the new things
		$newTitle = $_POST['title'];
		$newBody = $_POST['body'];
		$newImage = $_POST['image'];
		
		$isFilm = isset($filmID)?1:0;
		
		$error = !createEdit($articleID, $uid, $newTitle, $newBody, $newImage, $article['title'], $article['body'], $article['imageName'], $isFilm, $filmID, $personnelID);
	
	}
	
?>
<html>
<head>
	<title>Imdb clone</title>
	<link rel="stylesheet" type="text/css" href="../private/style/css/style.css"></head>
</head>
<body>
<a href="index.php">Back to index</a>

	<h1>Edit an article</h1>
	<form action="edit.php?articleID=<? 
										echo $articleID;
										echo isset($personnelID)?"&personnelID=$personnelID":'';
										echo isset($filmID)?"&filmID=$filmID":'';
															?>" id="editform" method="post">
	
		<label for="title">Title:</label>
		<input type="text" name="title" value="<? echo $article!=null?$article['title']:'' ?>">
		
		<label for="body">Body:</label>
		<textarea name="body" form = 'editform' rows='20' cols='100'><? echo $article!=null?$article['body']:'' ?></textarea>
		<br>
		
		<label for="image">Image filename:</label>
		<input type="text" name="image" value="<? echo $article!=null?$article['imageName']:''?>">
		
		<input type='submit' name='submit' value='Update info' <? echo $submitted && !$error?'disabled':''?>/>
	
	</form>

	<?php 
	
		if($submitted){
			if($error){
				echo 'Edit could not be submitted - there was some error.';
			}else{
				echo 'Edit submitted! Please wait until an admin approves it.';
			}
			br();
		}
	
	?>
	
</body>
</html>

