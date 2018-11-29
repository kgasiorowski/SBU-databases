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
// Basic wrapper function for all dynamic queries
function executeQuery($query, $argsArray, $singleVal = False, $getIndex = False, $index = ''){
	global $db;

	$stmt = $db->prepare($query);
	
	if(!$stmt){
		
		echo 'Error: Query '. $query .' could not be prepared';
		die();
		
	}
	
	$result = $stmt->execute($argsArray);
	
	if(!$result){
		
		echo 'Error: Query '. $query .' could not be executed with args';
		pr($argsArray);
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
	
	if(count($results) != 0){
		
		return $results['ID'];
		
	}else{
		
		return false;
		
	}
	
}

function userIsAdmin($userID){
	$query = 'SELECT COUNT(*) as userIsAdmin FROM adminv WHERE userID = ?';
	$args = array($userID);
	return executeQuery($query, $args, true, true, 'userIsAdmin');
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

function createEdit($articleID, $userID, $newTitle, $newBody, $newImage, $oldTitle, $oldBody, $oldImage, $isFilm, $filmID, $personnelID){
	$query = 'INSERT INTO editv(article_ID, old_title, new_title, old_body, new_body, old_image, new_image, userID, isFilm, newfilmID, newpersonnelID) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
	
	if($oldTitle != null && $oldBody != null && $oldImage != null)
		if(strcmp($newTitle, $oldTitle) == 0 && strcmp($newBody, $oldBody) == 0 && strcmp($newImage, $oldImage)==0)
			return false; // New stuff can't be the same as the old stuff
	
	if($oldTitle == null && $oldBody == null && $oldImage == null)
		if($newTitle == null || $newTitle == '' || $newBody == null || $newBody == '' || $newImage == null || $newImage == '')
			return false; // The new stuff can't be empty
	
	$args = array($articleID, $oldTitle, $newTitle, $oldBody, $newBody, $oldImage, $newImage, $userID, $isFilm, $filmID, $personnelID);
	executeQuery($query, $args);
	return true;
}

function filterDB($filters){
	
	$query = 'SELECT articlev.*, filmv.date_released, filmv.genreID, personnelv.birthdate FROM articlev LEFT OUTER JOIN filmv ON articlev.filmID = filmv.ID LEFT OUTER JOIN personnelv ON articlev.personnelID = personnelv.ID ';
	$args = [];
	
	$filterStrings = [];
	
	if(!empty($filters)){
	
		$query .= ' WHERE ';
	
		if(isset($filters['searchText'])){
			
			$query .= ' (body LIKE ? OR articlev.title LIKE ?) ';
			array_push($args, '%'.$filters['searchText'].'%', '%'.$filters['searchText'].'%');
			unset($filters['searchText']);
			
			if(count($filters) > 0)
				$query .= ' AND ';
			
		}
		
		if(isset($filters['filter'])){
			
			if($filters['filter'] == 'personnel'){
				
				$query .= ' isFilm = 0 ';
				
			}else if($filters['filter'] == 'films'){
				
				$query .= ' isFilm = 1 ';
				
			}
			
			unset($filters['filter']);
			if(count($filters)>0)
				$query .= ' AND ';
			
		}

		
		
		if(isset($filters['yearfilter'])){
			
			$query .= ' (YEAR(birthdate) = ? OR YEAR(date_released) = ?) ';
			array_push($args, $filters['yearfilter'], $filters['yearfilter']);
			unset($filters['yearfilter']);
			
			unset($filters['yearfilter']);
			if(count($filters)>0)
				$query .= ' AND ';
			
		}
		
		if(isset($filters['genrefilter'])){
			
			$query .= ' (genreID = ?) ';
			array_push($args, $filters['genrefilter']);
			unset($filters['genrefilter']);
			
		}
		
	}
	
	return executeQuery($query, $args);
	
}

function getArticle($articleID){
	// First we find if the article referenced by articleID is a film
	$query = 'SELECT * FROM articlev WHERE articleID=?';
	$args = array($articleID);
	$articleIsFilm = executeQuery($query, $args, true, true, 'isFilm');
	
	// Get all the article data
	if($articleIsFilm)
		$query = '
		SELECT 
			a.*, 
			f.rating, 
			f.score, 
			f.genre, 
			f.date_released, 
			f.duration_in_minutes, 
			f.language, 
			f.description 
		FROM 
			articlev a 
		INNER JOIN 
			filmv f ON a.filmID = f.ID 
		WHERE 
			a.articleID = ?';
	
	else
		$query = 'SELECT * FROM articlev INNER JOIN personnelv ON articlev.personnelID = personnelv.ID WHERE articleID = ?';
	
	return executeQuery($query, $args, true);
	
}

// This sql code is static, so no need for prep
function getUnapprovedEdits(){
	global $db;
	return $db->query($query = '
	(SELECT e1.*, u1.username
        FROM editv e1
        INNER JOIN
        (
        SELECT MAX(time_of_edit) latest_edit_date, article_ID
        FROM editv
        GROUP BY article_ID
        ) e2
        ON e1.article_ID = e2.article_ID
        AND e1.time_of_edit = e2.latest_edit_date
        INNER JOIN userv u1 on u1.ID = e1.userID
        WHERE time_of_approval IS NULL)
        UNION
        (SELECT e.*, u.username
        FROM editv e
        INNER JOIN userv u on u.ID = e.userID
        WHERE e.article_ID IS NULL
        )
	')->fetchAll(PDO::FETCH_ASSOC);
}

function getEditByID($editID){
	$query = 'SELECT * FROM editv WHERE ID = ? LIMIT 1';
	$args = array($editID);
	return executeQuery($query, $args, true);		
}

function approveEdit($editID, $adminID){
	$query = 'UPDATE editv SET approved_by_admin_ID = ?, time_of_approval = ? WHERE ID = ?';
	$args = array($adminID, date("Y-m-d H:i:s"), $editID);
	executeQuery($query, $args);
	
	$query = 'SELECT * FROM editv WHERE ID = ?';
	$args = array($editID);
	$editdata = executeQuery($query, $args, true);
	
	if(isset($editdata['article_ID'])){
	
		$query = '
		UPDATE articlev SET 
			title = (SELECT new_title FROM editv WHERE ID = ? LIMIT 1),
			body = (SELECT new_body FROM editv WHERE ID = ? LIMIT 1),
			imageName = (SELECT new_image FROM editv WHERE ID = ? LIMIT 1)
		WHERE 
			articleID = (SELECT article_ID FROM editv WHERE ID = ? LIMIT 1)
		';
		$args = array($editID, $editID, $editID, $editID);
	
	}else{
		
		$query = 'INSERT INTO article(filmID, personnelID, isFilm, original_author_id, title, body, imageName) VALUES(?, ?, ?, ?, ?, ?, ?)';
		$args = array($editdata['newfilmID'], $editdata['newpersonnelID'], $editdata['isFilm'], $editdata['userID'], $editdata['new_title'], $editdata['new_body'], '');
		
	}
	executeQuery($query, $args);
	
	// Now just update the old edit to set the article_ID
	if(true){
		if($editdata['isFilm']){
			
			$query = 'UPDATE editv SET article_ID = (SELECT articleID FROM articlev WHERE filmID = ?) WHERE ID = ? AND article_ID IS NULL';
			$args = array($editdata['newfilmID'], $editID);
			
		}else{
			
			$query = 'UPDATE editv SET article_ID = (SELECT articleID FROM articlev WHERE personnelID = ?) WHERE ID = ? AND article_ID IS NULL';
			$args = array($editdata['newpersonnelID'], $editID);
			
		}
	}
	executeQuery($query, $args);
	
}

function getFilmInfo($articleID){
	$query = '
	SELECT 
		rating, 
		score, 
		genre, 
		CONCAT(MONTHNAME(date_released), " ", DAY(date_released), ", ", YEAR(date_released)) AS date_released, 
		duration_in_minutes, 
		language, 
		description 
	FROM 
		filmv 
	WHERE ID = (SELECT filmID FROM articlev WHERE articleID = ?)';
	$args = array($articleID);
	return executeQuery($query, $args, true);
}

function getPersonnelInfo($articleID){
	$query = '
	SELECT 
		fullname AS full_name, 
		gender, 
		CONCAT(MONTHNAME(birthdate), " ", DAY(birthdate), ", ", YEAR(birthdate)) AS birthday, 
		description, 
		height 
	FROM 
		personnelv 
	WHERE 
		ID = (SELECT personnelID FROM articlev WHERE articleID = ?)';
	$args = array($articleID);
	return executeQuery($query, $args, true);
}

function getGenres(){
	global $db;
	$query = 'SELECT * FROM genrev';
	return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

function getRatings(){
	global $db;
	$query = 'SELECT * FROM ratingv';
	return $db->query($query)->fetch(PDO::FETCH_ASSOC);
}

?>