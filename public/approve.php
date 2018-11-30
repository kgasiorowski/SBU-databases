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
<?php 
	
	$aid = getAdminID($uid);
	
	pr($aid);
	
	approveEdit($editID, $aid);
	
	echo '<h2>Success</h2>';
	echo 'Edit successfully approved and applied.<br>';
	echo 'Click <a href="user.php">here</a> to return to your user page.';
	
?>
	
	
</body>
</html>
