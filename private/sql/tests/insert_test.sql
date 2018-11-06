/*

This script checks that all triggers function in all the tables. 
First it clears all the data and attempts to insert invalid values.
All of the queries should fail.

*/

-- Clear everything
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE credit;
TRUNCATE TABLE personnel;
TRUNCATE TABLE film;
SET FOREIGN_KEY_CHECKS = 1;

-- Add some values to film
INSERT INTO film (title, rating, score, genre, date_released, duration_in_minutes, language, description) VALUES 
("Cast Away","PG13", 7.8, "Drama", "2000-12-22", 143, "English", "guy literally gets cast away")
;

INSERT INTO film (title, rating, score, genre, date_released, duration_in_minutes, language, description) VALUES 
("Cast Away","PG-13", 100, "Drama", "2000-12-22", 143, "English", "guy literally gets cast away")
;

INSERT INTO film (title, rating, score, genre, date_released, duration_in_minutes, language, description) VALUES 
("Cast Away","PG-13", 7.8, "Dama", "2000-12-22", 143, "English", "guy literally gets cast away")
;

-- Add some values to personnel
INSERT INTO personnel (firstname, lastname, gender, birthdate) VALUES
("Tom", "Hanks", "J", "1956-07-09")
;

-- Add some credits, linking the two tables together
INSERT INTO credit (personnelID, filmID, role) VALUES
(
    (SELECT ID FROM personnel WHERE firstname="Tom"), 
    (SELECT ID FROM film WHERE title="Apollo 13"), 
    "Acor"

);

INSERT INTO article(filmID, personnelID, isFilm, original_author_id, title, body) VALUES
(1, 2, TRUE, 1, "Inception", "Sample text for inception article");

INSERT INTO article(filmID, personnelID, isFilm, original_author_id, title, body) VALUES
(NULL, NULL, FALSE, 1, "Leonardo DiCaprio", "Sample text for Leo article");

INSERT INTO article(filmID, personnelID, isFilm, original_author_id, title, body) VALUES
(1, NULL, FALSE, 1, "Leonardo DiCaprio", "Sample text for Leo article");

INSERT INTO article(filmID, personnelID, isFilm, original_author_id, title, body) VALUES
(NULL, 1, TRUE, 1, "Leonardo DiCaprio", "Sample text for Leo article");
