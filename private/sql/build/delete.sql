/*

Deletes all tables in the database in the correct order to avoid
foreign key errors.

*/


-- Delete everything
DROP TABLE IF EXISTS 
    credit,
    edit,
    article,
    film,
    personnel,
    rating,
    genre,
    role,
    admin,
    user;


DROP PROCEDURE IF EXISTS `select_credits`;
DROP PROCEDURE IF EXISTS `select_admin`;
DROP PROCEDURE IF EXISTS `select_film_article`;
DROP PROCEDURE IF EXISTS `select_personnel_article`;
