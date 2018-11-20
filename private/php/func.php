<?php 

//Functions go here
function br(){
	echo '<br>';
}

function filterDB($searchString, $filter){
	
	global $db;
	
	$query = 'SELECT * FROM articlev WHERE ';
				
	if($filter == 'personnel')
		$query .= 'isFilm = 0 AND ';
	else if($filter == 'films')
		$query .= 'isFilm = 1 AND ';
	
	$query .= 'body LIKE \'%'.$searchString.'%\';';
	
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

?>