<?php 

	require_once("../private/php/init.php"); 
	$submitted = isset($_POST['username']) && isset($_POST['password']);
	
?>

<html>
<head>
	<title>Imdb clone</title>
	<link rel="stylesheet" type="text/css" href="../private/style/css/style.css"></head>
</head>
<body>
	
	<a href="index.php">Click here to go back</a>
	<h1>Create an account</h2>

	<form id='createAccount' action='createAccount.php' method='post'>
	
		<label for='username'>Username:</label>
		<input type='text' name = 'username' id = 'username' maxlength='50'>
		<br>
		<label for='password'>Password:</label>
		<input type='password' name='password' id='password' maxlength='50'>
		<br>
		<input type='submit' name='Submit' value='submit'/>
	
	</form>
	<br>
	
	<?php 
	
	if($submitted){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if(!createUser($username, $password)){
			
			echo 'User not created, username already taken.';
			
		}else{
			
			echo 'User successfully created!';
			
		}
		
	}
	
	?>
	
</body>
</html>