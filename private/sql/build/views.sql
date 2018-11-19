DROP VIEW IF EXISTS credits;

CREATE VIEW credits AS 
SELECT
    credit.ID as creditID,
    personnel.ID as personnelID,
    CONCAT(personnel.firstname, " ", personnel.lastname) as name,
    personnel.gender,
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

