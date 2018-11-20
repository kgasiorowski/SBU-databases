/*

	Here are all the views defined for interaction with this database.
	
	Views are used for two main reasons: 
	
	1. Simplicity for the user
	2. The underlying database can be changed without
	   the frontend also needing to be changed
	
	TODO: Create a new user for this website to use which hides
	all the regular tables and shows only the views.

*/

DROP VIEW IF EXISTS creditv;
CREATE VIEW creditv AS 
SELECT
	credit.ID as creditID,
    personnel.ID as personnelID,
	film.ID as filmID,
    CONCAT(personnel.firstname, " ", personnel.lastname) as name,
    personnel.gender,
    personnel.birthdate,
    film.title,
    rating.rating,
    film.score,
    genre.genre,
    role.role
FROM credit
INNER JOIN personnel ON credit.personnelID = personnel.ID
INNER JOIN film ON credit.filmID = film.ID
INNER JOIN role ON credit.roleID = role.ID
INNER JOIN genre ON film.genreID = genre.ID
INNER JOIN rating ON film.ratingID = rating.ID
ORDER BY credit.ID;

DROP VIEW IF EXISTS adminv;
CREATE VIEW adminv AS
SELECT
    userID,
    firstName,
    lastName,
    email
FROM admin
INNER JOIN user ON user.ID = userID;

DROP VIEW IF EXISTS personnelv;
CREATE VIEW personnelv AS
SELECT
    personnel.ID,
    CONCAT(personnel.firstname, " ", personnel.lastname) AS fullname,
	personnel.firstname,
	personnel.lastname,
    personnel.gender,
    personnel.birthdate,
    description,
    height
FROM personnel
ORDER BY personnel.ID;

DROP VIEW IF EXISTS filmv;
CREATE VIEW filmv AS
SELECT
    film.ID as ID,
    film.title,
    rating.rating,
    film.score,
    genre.genre,
    film.date_released,
    film.duration_in_minutes,
    film.language,
    film.description
FROM film
INNER JOIN genre ON genre.ID = film.genreID
INNER JOIN rating ON rating.ID = film.ratingID;

DROP VIEW IF EXISTS articlev;
CREATE VIEW articlev AS
SELECT 
	article.ID AS articleID, 
	isFilm,
	filmID,
	personnelID,
	user.username AS author, 
	CONCAT(user.firstname, " ", user.lastname) AS fullname, 
	title, 
	body,
	imageName
FROM 
	article 
INNER JOIN 
	user ON user.ID = original_author_id;
