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
INSERT INTO credit (personnel_ID, film_ID, role) VALUES
(
    (SELECT ID FROM personnel WHERE firstname="Tom"), 
    (SELECT ID FROM film WHERE title="Cast Away"), 
    "Actor"

);

UPDATE credit SET role = "Actng";
