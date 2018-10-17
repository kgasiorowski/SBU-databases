SELECT 
    credit.ID, 
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

ORDER BY
    credit.ID
;
