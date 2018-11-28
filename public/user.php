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
	
	br();
	echo '<h3>Your articles:</h3>';
	
	$articles = getArticlesByUsername($username);

	if(count($articles) != 0){
	
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
	
	}else{
		
		echo 'There are no articles associated with this account.';
		
	}
	
	
	
	if(userIsAdmin($uid)){
		
		$edits = getUnapprovedEdits();
		
		echo '<h3>Latest unapproved edits</h3>';

		if(count($edits) == 0){
			
			echo 'There are no pending edits.';
			
		}else{
		
			echo '<table id="table_border">';
						
			echo '<tr>';
			echo '<th> Article ID </th><th> User </th><th> Title diff </th><th> Body diff </th><th></th>';
			echo '</tr>';

			foreach($edits as $row){
				
				echo '<tr>';
				echo "<td><a href='article.php?articleID=$row[article_ID]'>$row[article_ID]</a></td>";
				echo "<td>$row[username]</td>";
				echo "<td><pre>".xdiff_string_diff($row['old_title'], $row['new_title'], 1, true)."</pre></td>"; 
				echo "<td><pre>".xdiff_string_diff($row['old_body'], $row['new_body'], 3, true)."</pre></td>"; 
				echo "<td><a href='approve.php?editID=".$row['ID']."'>Approve</a></td>";
				echo '</tr>';
				
			}

			echo '</table>';
		
		}
		
	}
	
	
?>
	
</body>
</html>
