<?php 

//Functions go here
function br(){
	echo '<br>';
}

function pr($arg){
	echo '<pre>';
	print_r($arg);
	echo '</pre>';
}

function filterDB($searchString, $filter){
	
	global $db;
	
	$query = 'SELECT * FROM articlev WHERE ';
				
	if($filter == 'personnel')
		$query .= 'isFilm = 0 AND ';
	else if($filter == 'films')
		$query .= 'isFilm = 1 AND ';
	
	$query .= '(body LIKE \'%'.$searchString.'%\' OR title LIKE \'%'.$searchString.'%\');';
	
	return $db->query($query);
	
}

function getArticle($articleID){
	
	global $db;
	
	$query = 'SELECT * FROM articlev WHERE articleID='.$articleID;
	$article = $db->query($query)->fetch(PDO::FETCH_ASSOC);
	
	if($article['isFilm']){
		$query = 'SELECT * FROM articlev INNER JOIN filmv ON articlev.filmID = filmv.ID WHERE articleID = '.$articleID.';';
	}else{
		$query = 'SELECT * FROM articlev INNER JOIN personnelv ON articlev.personnelID = personnelv.ID WHERE articleID = '.$articleID.';';
	}
	
	$article = $db->query($query)->fetch(PDO::FETCH_ASSOC);
	return $article;
	
}

function getCredits($personnelID){
	global $db;
	return $db->query('SELECT * FROM creditv WHERE personnelID = ' . $personnelID . ';');
}

function getFilmRoles($filmID){
	global $db;
	return $db->query('SELECT * FROM creditv WHERE filmID = '. $filmID .' ORDER BY role;');
}

function getArticleIDByPersonnelID($personnelID){
	global $db;
	return $db->query('SELECT articleID FROM articlev WHERE personnelID = '.$personnelID.';')->fetch(PDO::FETCH_ASSOC)['articleID'];
}

function getArticleIDByFilmID($filmID){
	global $db;
	return $db->query('SELECT articleID FROM articlev WHERE filmID = '.$filmID.';')->fetch(PDO::FETCH_ASSOC)['articleID'];
}

function getArticlesByUsername($username){
	global $db;
	return $db->query('SELECT * FROM articlev WHERE author = \''.$username.'\'');
}

//Returns the user ID or false if login failed
function verifyLogin($username, $password){
	global $db;
	$query = 'SELECT ID FROM userv WHERE username = \''.$username.'\' AND password = \''.$password.'\';';
	$result = $db->query($query);
	
	if($result->rowCount() > 0){
		
		$result = $result->fetch(PDO::FETCH_ASSOC)['ID'];
		return $result;
		
	}else{
		//Query failed, user not found
		return False;
	
	}
	
}

function userISAdmin($userID){
	global $db;
	return $db->query('SELECT COUNT(*) as userIsAdmin FROM adminv WHERE userID = \''.$userID.'\';')->fetch(PDO::FETCH_ASSOC)['userIsAdmin'];
}

// If there already exists a tuple with the given username, return false
function createUser($username, $password){
	global $db;
	
	$query = 'SELECT COUNT(*) as userExists FROM userv WHERE username = \''.$username.'\';';
	$result = $db->query($query)->fetch(PDO::FETCH_ASSOC)['userExists'];
	
	if($result){
		return False;
	}else{
		// Try to insert the new user
		$query = 'INSERT INTO userv(username, password) VALUES (?, ?);';
		$result = $db->prepare($query)->execute([$username, $password]);
		return True;
	}
	
}

function getUserByID($id){
	global $db;
	
	$query = 'SELECT * FROM userv WHERE ID = \''.$id.'\';';
	return $db->query($query)->fetch(PDO::FETCH_ASSOC);
	
}

function updateUserInfo($firstname, $lastname, $email, $id){
	global $db;
	
	$query = 'UPDATE userv SET firstname = ?, lastname = ?, email = ? WHERE ID = ?';
	$db->prepare($query)->execute([$firstname, $lastname, $email, $id]);
	
}

?>