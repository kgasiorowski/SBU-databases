<?php 

	require_once("../private/php/init.php"); 

	$submitted = $_SERVER['REQUEST_METHOD'] == 'POST';
	$loggedin = isset($_SESSION['uid']) && isset($_SESSION['username']);
	
	if($submitted){
		$filters = array();
		
		if(isset($_POST['filter']) && $_POST['filter'] != 'both')
			$filters['filter'] = $_POST['filter'];
		
		if(isset($_POST['searchText']) && $_POST['searchText'] != '')
			$filters['searchText'] = $_POST['searchText'];
		
		if(isset($_POST['yearfilter']) && $_POST['yearfilter'] != '')
			$filters['yearfilter'] = $_POST['yearfilter'];
	
	}
	
?>

<html>
<head>
	<title>Imdb clone</title>
	<link rel="stylesheet" type="text/css" href="../private/style/css/style.css"></head>
</head>
<body>

	<?php 
	
		if($loggedin){
	
			echo 'Logged in as \''.$_SESSION['username'].'\' (<a href=\'login.php?logout\'>logout</a> here)';
			br();
			echo 'Click <a href="user.php">here</a> to access your user page.<br>';
		
		}else{
			
			echo 'Not logged in<br>';
			echo 'Log in <a href=\'login.php\'>here</a><br>';
			echo 'Or create an account <a href=\'createAccount.php\'>here</a><br>';
			
		}
	
	?>
	
	<img src="<? echo IMG_PATH?>imdbc_icon.png">
	
	<h1>Welcome to IMDBc, the most popular IMDB clone</h1>
	
	<h2>Main page</h2>
	
	<h3>Filter the database:</h3>
	
	<form action="index.php" id="filterForm" method="post">
	
		Limit search to: 
		
		<select name="filter" form="filterForm" class="nonblock">
		
			<option value="both" <? 
			echo isset($filters['filter']) && $filters['filter'] == 'both'? 'selected':'';
			?>>Both</option>
			
			<option value="personnel" <? 
			echo isset($filters['filter']) && $filters['filter'] == 'personnel'? 'selected':'';
			?>>Personnel</option>
			
			<option value="films" <?
			echo isset($filters['filter']) && $filters['filter'] == 'films'? 'selected':'';
			?>>Films</option>
			
		</select><br>
		<br>
		Search for: <input type="text" name="searchText" value="<? echo $submitted && isset($filters['searchText'])?$filters['searchText']:'' ?>" class="nonblock"><br>
		<br>
		Year: <input type="number" name="yearfilter" min="1850" class="nonblock" value="<? echo $submitted && isset($filters['yearfilter'])?$filters['yearfilter']:''?>"><br>
		<br>
		
		<?php 
	
		if($submitted){
			
			$results = filterDB($filters);

			if($results && count($results) != 0)
			{
				echo '<table id="table_border">';
				
				echo '<tr>';
				echo '<th> Article ID </th><th> Title </th><th> Body </th><th> Author Username </th><th> Author Full Name </th>';
				echo '</tr>';
				
				foreach($results as $row){
					
					echo '<tr>';
					echo "<td><a href='article.php?articleID=$row[articleID]'>$row[articleID]</a></td><td>$row[title]</td><td>$row[body]</td><td>$row[author]</td><td>$row[fullname]</td>";
					echo '</tr>';
					
				}
				
				echo '</table>';
				
			}else{
				
				echo 'No results found for those filters. Try again with different settings.';
				br();
				
			}
			
			br();
			
		}
	
		?>
		
		<input type="submit" value="Search">
	
	</form>
	
</body>   
</html>