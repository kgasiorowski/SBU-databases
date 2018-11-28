use imdbc;

UPDATE articlev SET 
	title = (SELECT new_title FROM editv WHERE ID = 2 LIMIT 1),
	body = (SELECT new_body FROM editv WHERE ID = 2 LIMIT 1),
WHERE 
	articleID = (SELECT article_ID FROM editv WHERE ID = 2 LIMIT 1);
