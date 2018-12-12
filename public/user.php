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
		<input type="text" name="firstname" value="<? secho($user['firstName']) ?>">
		
		<label for="lastname">Last name:</label>
		<input type="text" name="lastname" value="<? secho($user['lastName']) ?>">
		
		<label for="email">Email:</label>
		<input type="text" name="email" value="<? secho($user['email']) ?>">
	
		<br>
		<input type='submit' name='submit' value='Update info'/>
	
	</form>
	
	<?php
	
	echo '<h3>Your articles:</h3>';
	
	$articles = getArticlesByUsername($username);

	if(count($articles) != 0){
	
		echo '<table id="table_border">';
					
		echo '<tr>';
		echo '<th> Article ID </th><th> Title </th>';
		echo '</tr>';

		foreach($articles as $row){
			
			echo '<tr>';
			echo "<td><a href='article.php?articleID=$row[articleID]'>".h($row['articleID'])."</a></td><td>".h($row['title'])."</td>";
			echo '</tr>';
			
		}

		echo '</table>';
	
	}else{
		
		echo 'There are no articles associated with this account.';
		echo '<hr>';
		
	}
	
	
	
	if(userIsAdmin($uid)){
		
		$edits = getUnapprovedEdits();
		
		echo '<h3>Latest unapproved edits</h3>';

		if(count($edits) == 0){
			
			echo 'There are no pending edits.';
			
		}else{
		
			echo '<table id="table_border">';
						
			echo '<tr>';
			echo '<th> Article ID </th><th> User </th><th> Title diff </th><th> Body diff </th><th> Image Name Diff </th><th></th>';
			echo '</tr>';

			foreach($edits as $row){
				
				echo '<tr>';
				echo "<td><a href='article.php?articleID=$row[article_ID]'>$row[article_ID]</a></td>";
				echo '<td>'.h($row['username']).'</td>';
				echo "<td><pre>".h(xdiff_string_diff($row['old_title'], $row['new_title']))."</pre></td>"; 
				echo "<td><pre>".h(xdiff_string_diff($row['old_body'], $row['new_body']))."</pre></td>";
				echo "<td><pre>".h(xdiff_string_diff($row['old_image'], $row['new_image']))."</pre></td>";				
				echo "<td><a href='approve.php?editID=".h($row['ID'])."'>Approve</a></td>";
				echo '</tr>';
				
			}

			echo '</table>';
		
		}
		
		echo '<hr>';
		
		?>
	
		<h3>Image Upload Form</h3>
		
		<form action='user.php' method='post' enctype='multipart/form-data'>
		
			<input type="file" name="fileToUpload" id="fileToUpload"/><br>
			<input type="submit" value="Upload Picture" name="upload"/>
		
		</form>
		
		<?
		
		if(isset($_POST['upload'])){
		
			$target_dir = IMG_PATH;
			$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
			$uploadOk = true;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			
			if($_FILES['fileToUpload']['size'] > 2000000){
				echo 'Error: file too large';
				$uploadOk = false;
			}	
		
			if (file_exists($target_file)) {
				echo "Error: that file already exists";
				$uploadOk = false;
			}
				
			if($uploadOk){
				
				move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
				echo 'Upload successful!';
				
			}
			
		}
		
	}
	
	
?>
	
</body>
</html>
