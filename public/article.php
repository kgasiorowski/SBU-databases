<?php

	require_once("../private/php/init.php");

	//$articleID = null;
	
	if(isset($_GET['articleid']) && $_GET['articleid'] != ''){
		
		$articleID = $_GET['articleid'];
	
		getArticle($articleID);
	
	}

	
	
?>
<html>
<head>
	<title>Imdb clone</title>
	<link rel="stylesheet" type="text/css" href="../private/style/css/style.css"></head>
</head>
<body>
<?php echo isset($articleID)?"Article ID: $articleID":'No articleID given' ?><br>
This is the article page but it isn't implemented yet.<br>
<a href="index.php">Click here to go back.</a>
</body>
</html>
