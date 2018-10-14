use IMDB_clone;

SELECT 
    credit.ID, 
    personnel.firstname,
    personnel.lastname,
    personnel.gender,
    personnel.birthdate,
    film.title,
    film.rating,
    film.score,
    genre.genre,
    role.role
    
FROM credit
    INNER JOIN personnel ON credit.personnel_ID = personnel.ID
    INNER JOIN role ON credit.role_ID = role.ID
    INNER JOIN film ON credit.film_ID = film.ID
        INNER JOIN genre ON film.genre = genre.ID
