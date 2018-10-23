DELIMITER $

DROP PROCEDURE IF EXISTS `select_credits`$
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
    INNER JOIN personnel ON credit.personnel_ID = personnel.ID
    INNER JOIN film ON credit.film_ID = film.ID
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

DELIMITER ;

