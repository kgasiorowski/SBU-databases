DROP VIEW IF EXISTS credits;
CREATE VIEW credits AS 
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

DROP VIEW IF EXISTS admins;
CREATE VIEW admins AS
SELECT
    userID,
    firstName,
    lastName,
    email
FROM admin
INNER JOIN user ON user.ID = userID;

DROP VIEW IF EXISTS film_personnel;
CREATE VIEW film_personnel AS
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

DROP VIEW IF EXISTS films;
CREATE VIEW films AS
SELECT
    film.ID as filmID,
    film.title,
    film.rating,
    film.score,
    genre.genre,
    film.date_released,
    film.duration_in_minutes,
    film.language,
    film.description
FROM film
INNER JOIN genre ON genre.ID = film.genre;

DROP VIEW IF EXISTS articles;
CREATE VIEW articles AS
(
SELECT 
    article.ID AS articleID, 
    article.isFilm,
    user.username AS author,
    CONCAT(user.firstname, ' ', user.lastname) AS fullname, 
    article.title AS articletitle, 
    article.body AS articlebody 
FROM 
    article 
INNER JOIN
    user ON user.ID = original_author_id
INNER JOIN 
    personnel on personnel.id = personnelID
) UNION (
SELECT 
    article.ID AS articleID,
    article.isFilm, 
    user.username AS author,
    CONCAT(user.firstname, ' ', user.lastname) AS fullname, 
    article.title AS articletitle, 
    article.body AS articlebody 
FROM 
    article 
INNER JOIN
    user ON user.ID = original_author_id
INNER JOIN 
    film ON film.ID = filmID
);







