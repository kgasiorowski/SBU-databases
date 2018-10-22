use IMDB_clone;

SELECT 
    film.ID, 
    film.title, 
    film.rating, 
    film.score, 
    film.genre, 
    film.date_released, 
    film.duration_in_minutes, 
    film.language, 
    film.description 
FROM film;
