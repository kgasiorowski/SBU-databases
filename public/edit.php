<?php

	require_once("../private/php/init.php");
	
	if(!loggedIn()){
		
		header('Location: ./login.php');
		
	}
	
	$uid = $_SESSION['uid'];
	$articleID = isset($_GET['articleID'])?$_GET['articleID']:'';
	$article = getArticle($articleID);
	$submitted = isset($_POST['submit']);
	$error = false;
	
	if($submitted){
			
		// Get the new things
		$newTitle = $_POST['title'];
		$newBody = $_POST['body'];
		
		$error = !createEdit($articleID, $uid, $newTitle, $newBody, $article['title'], $article['body']);
	
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
	<form action="edit.php?articleID=<? echo $articleID; ?>" id="editform" method="post">
	
		<label for="title">Title:</label>
		<input type="text" name="title" value="<? echo $article['title'] ?>">
		
		<label for="body">Body:</label>
		<textarea name="body" form = 'editform' rows='20' cols='100'><? echo $article['body'] ?></textarea>
		<br>
		<input type='submit' name='submit' value='Update info' <? echo $submitted && !$error?'disabled':''?>/>
	
	</form>

	<?php 
	
		if($submitted){
			if($error){
				echo 'Edit could not be submitted - you must make some change.';
			}else{
				echo 'Edit submitted! Please wait until an admin approves it.';
			}
			br();
		}
	
	?>
	
</body>
</html>

