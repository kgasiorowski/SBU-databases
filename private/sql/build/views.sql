DROP VIEW IF EXISTS creditv;
CREATE VIEW creditv AS 
SELECT
    credit.ID as creditID,
    personnel.ID as personnelID,
    CONCAT(personnel.firstname, " ", personnel.lastname) as name,
    gender.gender,
    personnel.birthdate,
    film.ID as filmID,
    film.title,
    film.rating,
    film.score,
    film.genre,
    credit.role
FROM credit
INNER JOIN personnel ON credit.personnelID = personnel.ID
INNER JOIN film ON credit.filmID = film.ID
INNER JOIN gender ON gender.ID = personnel.gender
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
    CONCAT(personnel.firstname, " ", personnel.lastname) AS name,
    gender.gender,
    personnel.birthdate,
    description,
    height
FROM personnel
INNER JOIN gender ON gender.ID = personnel.gender
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
INNER JOIN genre ON genre.ID = film.genre
INNER JOIN rating ON rating.ID = film.rating;

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
	body 
FROM 
	article 
INNER JOIN 
	user ON user.ID = original_author_id;
