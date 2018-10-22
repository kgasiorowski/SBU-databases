/*

This script inserts a bunch of sample data into the database.

*/

-- Clear everything
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE credit;
TRUNCATE TABLE personnel;
TRUNCATE TABLE film;
SET FOREIGN_KEY_CHECKS = 1;

-- Add some values to film
INSERT INTO film (title, rating, score, genre, date_released, duration_in_minutes, language, description) VALUES 
("Inception", "R", 8.8, "Action", "2010-06-16", 148, "English", "within a DREAM"),
("Apollo 13", "PG", 7.6, "Drama", "1995-06-30", 140, "English", "astronauts have a bad week"),
("The Truman Show","PG", 8.1, "Comedy", "1995-06-05", 103, "English", "guy finds out he's a star in a TV show"),
("Cast Away","PG-13", 7.8, "Drama", "2000-12-22", 143, "English", "guy literally gets cast away")
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
INSERT INTO credit (personnel_ID, film_ID, role) VALUES
(
    (SELECT ID FROM personnel WHERE firstname="Tom"), 
    (SELECT ID FROM film WHERE title="Apollo 13"), 
    "Actor"

),
(

    (SELECT ID FROM personnel WHERE firstname="Leonardo"),
    (SELECT ID FROM film WHERE title="Inception"),
    "Actor"

),
(

    (SELECT ID FROM personnel WHERE firstname="Jim"),
    (SELECT ID FROM film WHERE title="The Truman Show"),
    "Actor"

),
(

    (SELECT ID FROM personnel WHERE firstname="Christopher"),
    (SELECT ID FROM film WHERE title="Inception"),
    "Director"

),
(

    (SELECT ID FROM personnel WHERE firstname="Ellen"),
    (SELECT ID FROM film WHERE title="Inception"),
    "Actor"

),
(

    (SELECT ID FROM personnel WHERE firstname="Tom"),
    (SELECT ID FROM film WHERE title="Cast Away"),
    "Actor"

),
(

    (SELECT ID FROM personnel WHERE firstname="Ron"),
    (SELECT ID FROM film WHERE title="Apollo 13"),
    "Director"

)

;