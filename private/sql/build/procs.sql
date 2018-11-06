DELIMITER $

DROP PROCEDURE IF EXISTS `select_credit`$
CREATE PROCEDURE `select_credits`()
DETERMINISTIC
BEGIN
    SELECT
        credit.ID as creditID,
        personnel.firstname,
        personnel.lastname,
        personnel.gender,
        personnel.birthdate,
        film.title,
        film.rating,
        film.score,
        film.genre,
        credit.role
    FROM credit
    INNER JOIN personnel ON credit.personnelID = personnel.ID
    INNER JOIN film ON credit.filmID = film.ID
    ORDER BY credit.ID;
END$

DROP PROCEDURE IF EXISTS `select_admin`$
CREATE PROCEDURE `select_admin`()
DETERMINISTIC
BEGIN
    SELECT userID, firstName, lastName, email
    FROM admin
    INNER JOIN user
    ON user.ID = userID;
END$

DROP PROCEDURE IF EXISTS `select_film_article`$
CREATE PROCEDURE `select_film_article`()
DETERMINISTIC
BEGIN
    SELECT
        article.ID,
        film.ID,
        original_author_id,
        article.title, 
        body
    FROM article
    INNER JOIN film
    ON film.ID = article.filmID;
END$

DROP PROCEDURE IF EXISTS `select_personnel_article`$
CREATE PROCEDURE `select_personnel_article`()
DETERMINISTIC
BEGIN
    SELECT 
        article.ID,
        personnel.ID,
        original_author_id,
        article.title,
        body
    FROM article
    INNER JOIN personnel
    ON article.personnelID = personnel.ID;
END$

DELIMITER ;
