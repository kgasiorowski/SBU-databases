use imdbc;

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
