use IMDB_clone;

SELECT 
    film.ID, 
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
