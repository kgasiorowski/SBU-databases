/*

Deletes all tables in the database in the correct order to avoid
foreign key errors.

*/


-- Delete everything
DROP TABLE IF EXISTS 
    credit,
    article,
    film,
    personnel,
    rating,
    genre,
    role,
    admin,
    user;
