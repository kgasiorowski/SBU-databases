<?php 

	require_once("../private/php/init.php");
	$loggedin = loggedIn();
	
	if($loggedin)
	{
		
		$uid = $_SESSION['uid'];
		$username = $_SESSION['username'];
		
	}
	
?>

<html>
<head>
	<title>Imdb clone</title>
	<link rel="stylesheet" type="text/css" href="../private/style/css/style.css">
</head>
<body>
<a href="index.php">Back to index</a>
<h1>User Page</h1>
<?php 
	
	if(!$loggedin){ 
		
		echo '<br><br>';
		echo 'You are not logged in. Please log in using <a href=\'login.php\'>this</a> link.';
		die();
		
	} 

	if(isset($_POST['submit'])){
			
			updateUserInfo($_POST['firstname'], $_POST['lastname'], $_POST['email'], $uid);
			echo 'Data updated successfully!';br();
	
	}
	
	$user = getUserByID($uid);
	
	?>
	
	<form action="user.php" id="" method="post">
	
		<label for="firstname">First name:</label>
		<input type="text" name="firstname" value="<? echo $user['firstName'] ?>">
		
		<label for="lastname">Last name:</label>
		<input type="text" name="lastname" value="<? echo $user['lastName'] ?>">
		
		<label for="email">Email:</label>
		<input type="text" name="email" value="<? echo $user['email'] ?>">
	
		<br>
		<input type='submit' name='submit' value='Update info'/>
	
	</form>
	
	<?php
	
	$articles = getArticlesByUsername($username);

	br();
	echo 'Your articles:';
	
	echo '<table id="table_border">';
				
	echo '<tr>';
	echo '<th> Article ID </th><th> Title </th>';
	echo '</tr>';
	
	foreach($articles as $row){
		
		echo '<tr>';
		echo "<td><a href='article.php?articleID=$row[articleID]'>$row[articleID]</a></td><td>$row[title]</td>";
		echo '</tr>';
		
	}

	echo '</table>';

?>
	
</body>
</html>
