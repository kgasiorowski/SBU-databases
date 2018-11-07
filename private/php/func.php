<?php 

//Functions go here

function br(){
	
	echo '<br>';
	
}

// Queries I need to save:

/*

// Basic query
$results = $db->query('SELECT ID, title, revenue FROM film ORDER BY revenue DESC;');

while($row = $results->fetch(PDO::FETCH_ASSOC)){
	
	echo "$row[ID], $row[title], $$row[revenue]";
	br();
	
}
	
// Gets formatted personnel data
SELECT 
	CONCAT(MONTHNAME(birthdate), " ", DAY(birthdate), ", ", YEAR(birthdate)) AS bday_string, 
	CONCAT(firstname, " ", lastname) AS fullname, 
	birthdate 
FROM 
	personnel;

*/

?>