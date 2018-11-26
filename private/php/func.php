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

function loggedIn(){
	
	return isset($_SESSION['uid']) && isset($_SESSION['username']);
	
}

function executeQuery($query, $argsArray, $singleVal = False, $getIndex = False, $index = ''){
	global $db;

	$stmt = $db->prepare($query);
	
	if(!$stmt){
		
		echo 'Error: Query '. $query .' could not be prepared';
		die();
		
	}
	
	$result = $stmt->execute($argsArray);
	
	if(!$result){
		
		echo 'Error: Query '. $query .' could not be executed with args ' . $argsArray;
		die();
		
	}
	
	if($singleVal){
		
		if($getIndex) 
			return $stmt->fetch(PDO::FETCH_ASSOC)[$index];
		else
			return $stmt->fetch(PDO::FETCH_ASSOC);
			
	
	}else
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	
}

function getCredits($personnelID){
	$query = 'SELECT * FROM creditv WHERE personnelID = ?';
	$args = array($personnelID);
	return executeQuery($query, $args);
}

function getFilmRoles($filmID){
	$query = 'SELECT * FROM creditv WHERE filmID = ? ORDER BY role, personnelID';
	$args = array($filmID);
	return executeQuery($query, $args);
}

function getArticleByPersonnelID($personnelID){
	$query = 'SELECT * FROM articlev WHERE personnelID = ?';
	$args = array($personnelID);
	return executeQuery($query, $args, true, true, 'articleID');
}

function getArticleByFilmID($filmID){
	$query = 'SELECT * FROM articlev WHERE filmID = ?';
	$args = array($filmID);
	return executeQuery($query, $args, true, true, 'articleID');
	
}

function getArticlesByUsername($username){
	$query = 'SELECT * FROM articlev WHERE author = ?';
	$args = array($username);
	return executeQuery($query, $args);
}

//Returns the user ID or false if login failed
function verifyLogin($username, $password){
	
	$query = 'SELECT ID FROM userv WHERE username = ? AND password = ?';
	$args = array($username, $password);
	
	$results = executeQuery($query, $args, true);
	
	pr($results);
	
	if(count($results) != 0){
		
		return $results['ID'];
		
	}else{
		
		return false;
		
	}
	
}

function userISAdmin($userID){
	$query = 'SELECT COUNT(*) as userIsAdmin FROM adminv WHERE userID = ?';
	$args = array($userID);
	return executeQuery($query, $args, true, true, 'userIdAdmin');
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
	$query = 'SELECT * FROM userv WHERE ID = ?';
	$args = array($id);
	return executeQuery($query, $args, true);
}

function updateUserInfo($firstname, $lastname, $email, $id){
	$query = 'UPDATE userv SET firstname = ?, lastname = ?, email = ? WHERE ID = ?';
	$args = array($firstname, $lastname, $email, $id);
	executeQuery($query, $args);
}

function filterDB($searchString, $filter){
	
	$str = '%' . $searchString . '%';
	$args = array($str, $str);
	$query = 'SELECT * FROM articlev WHERE ';
				
	if($filter == 'personnel')
		$query .= 'isFilm = 0 AND ';
	else if($filter == 'films')
		$query .= 'isFilm = 1 AND ';
	
	$query .= '(body LIKE ? OR title LIKE ?);';
	
	return executeQuery($query, $args);
	
}

function getArticle($articleID){
	// First we find if the article referenced by articleID is a film
	$query = 'SELECT * FROM articlev WHERE articleID=?';
	$args = array($articleID);
	$articleIsFilm = executeQuery($query, $args, true, true, 'isFilm');
	
	// Get all the article data
	if($articleIsFilm)
		$query = 'SELECT * FROM articlev INNER JOIN filmv ON articlev.filmID = filmv.ID WHERE articleID = ?';
	else
		$query = 'SELECT * FROM articlev INNER JOIN personnelv ON articlev.personnelID = personnelv.ID WHERE articleID = ?';
	
	return executeQuery($query, $args, true);
	
}

?>