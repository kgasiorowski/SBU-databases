<?php 

	require_once("../private/php/init.php");

	if(isset($_GET['logout'])){
		
		session_destroy();
		echo 'Successfully logged out<br>';
		
	}
	
	$submitted = isset($_POST['username']) && isset($_POST['password']);
	
	if($submitted){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if($uid = verifyLogin($username, $password)){
			
			$_SESSION['uid'] = $uid;
			$_SESSION['username'] = $username;
			
			header('Location: ./index.php');
			
		}
		
	}
	
?>

<html>
<head>
	<title>Imdb clone</title>
	<link rel="stylesheet" type="text/css" href="../private/style/css/style.css">
</head>
<body>

	<a href="index.php">Back to index</a>
	<h1>Login</h2>
	<form id='login' action='login.php' method='post'>
	
		<label for='username'>Username:</label>
		<input type='text' name = 'username' id = 'username' maxlength='50'>
		<br>
		<label for='password'>Password:</label>
		<input type='password' name='password' id='password' maxlength='50'>
		<br>
		<input type='submit' name='Submit' value='Submit'/>
	
	</form>

</body>
</html>
