
UNION SELECT 
	article.ID AS articleID, 
	user.username as author,
	CONCAT(user.firstname, ' ', user.lastname) AS fullname, 
	article.title AS articletitle, 
	article.body AS articlebody 
FROM 
	article 
INNER JOIN
	user ON user.ID = original_author_id
INNER JOIN 
	personnel on personnel.ID = personnelID 
WHERE 
	article.title LIKE "%%" 
	OR 
	article.body LIKE "%%" 