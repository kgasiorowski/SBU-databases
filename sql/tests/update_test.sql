/*

This script checks that all "update" triggers function in all tables.
First it clears all the tables, inserts valid info, and tries to update
it to invalid data. All of these queries should fail. 
 
*/

-- Clear everything
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE credit;
TRUNCATE TABLE personnel;
TRUNCATE TABLE film;
TRUNCATE TABLE article;
SET FOREIGN_KEY_CHECKS = 1;

-- Add some values to film
INSERT INTO film (title, rating, score, genre, date_released, duration_in_minutes, language, description) VALUES 
("Cast Away","PG-13", 7.8, "Drama", "2000-12-22", 143, "English", "guy literally gets cast away")
;

UPDATE film SET rating = "PG13";
UPDATE film SET score = 200;
UPDATE film SET genre = "xd ayy lmao";

-- Add some values to personnel
INSERT INTO personnel (firstname, lastname, gender, birthdate) VALUES
("Tom", "Hanks", "M", "1956-07-09");

UPDATE personnel SET gender = "L";

-- Add some credits, linking the two tables together
INSERT INTO credit (personnelID, filmID, role) VALUES
(
    (SELECT ID FROM personnel WHERE firstname="Tom"), 
    (SELECT ID FROM film WHERE title="Cast Away"), 
    "Actor"

);

UPDATE credit SET role = "Actng";

-- Add some articles
INSERT INTO article(filmID, personnelID, isFilm, original_author_id, title, body) VALUES
(1, NULL, TRUE, 1, "Inception", "Sample text for inception article"),
(NULL, 1, FALSE, 1, "Leonardo DiCaprio", "Sample text for Leo article"),
(1, NULL, TRUE, 3, "Apollo 13", "Sample text for Apollo 13"),
(NULL, 1, FALSE, 4, "Jim Carey", "Sample text for Jim Carey");

-- Test all article constraints
UPDATE article SET filmID = 1 WHERE filmID IS NULL;
UPDATE article SET personnelID = 1 WHERE filmID IS NOT NULL;
UPDATE article SET isFilm = 1 WHERE personnelID IS NOT NULL;
UPDATE article SET isFilm = 0 WHERE personnelID IS NULL;
