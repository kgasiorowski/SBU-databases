<?php 
	
	require_once("../private/php/init.php");
	$loggedin = loggedIn();
	$editID = isset($_GET['editID'])?$_GET['editID']:null;
	
	if($loggedin && $editID != null)
	{
		
		$uid = $_SESSION['uid'];
		$username = $_SESSION['username'];
		
	}else{
		
		header('Location: index.php');
		die();
		
	}
	
?>

<html>
<head>
	<title>Imdb clone</title>
	<link rel="stylesheet" type="text/css" href="../private/style/css/style.css">
</head>
<body>

<a href="index.php">Back to index</a>
<br>
<a href="user.php">Back to your user page</a>
	
<?php 
	
	approveEdit($editID, $uid);

?>
	
	
</body>
</html>
