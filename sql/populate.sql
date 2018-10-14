use IMDB_clone;

-- Clear everything
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE credit;
TRUNCATE TABLE personnel;
TRUNCATE TABLE film;
SET FOREIGN_KEY_CHECKS = 1;

-- Add some values to film
INSERT INTO film (title, rating, score, genre, date_released, duration_in_minutes, language, description) VALUES 
("Inception", "R", 8.8, (SELECT genre.ID FROM genre WHERE genre = "Action"), "2010-06-16", 148, "English", "within a DREAM"),
("Apollo 13", "PG", 7.6, (SELECT genre.ID FROM genre WHERE genre = "Drama"), "1995-06-30", 140, "English", "astronauts have a bad week"),
("The Truman Show","PG", 8.1, (SELECT genre.ID FROM genre WHERE genre = "Comedy"), "1995-06-05", 103, "English", "guy finds out he's a star in a TV show"),
("Cast Away","PG-13", 7.8, (SELECT genre.ID FROM genre WHERE genre = "Drama"), "2000-12-22", 143, "English", "guy literally gets cast away")
;


-- Add some values to personnel
INSERT INTO personnel (firstname, lastname, gender, birthdate) VALUES
("Tom", "Hanks", "M", "1956-07-09"),
("Leonardo", "DiCaprio", "M", "1974-11-11"),
("Christopher", "Nolan", "M", "1970-07-30"),
("Ellen", "Paige", "F", "1987-02-21"),
("Jim", "Carrey", "M", "1962-01-17"),
("Ron", "Howard", "M", "1954-03-01")
;

-- Add some credits, linking the two tables together
INSERT INTO credit (personnel_ID, film_ID, role_ID) VALUES
(
    (SELECT ID FROM personnel WHERE firstname="Tom"), 
    (SELECT ID FROM film WHERE title="Apollo 13"), 
    (SELECT ID FROM role WHERE role="Actor")

);
