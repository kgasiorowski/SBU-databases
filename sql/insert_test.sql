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
INSERT INTO credit (personnel_ID, film_ID, role) VALUES
(
    (SELECT ID FROM personnel WHERE firstname="Tom"), 
    (SELECT ID FROM film WHERE title="Apollo 13"), 
    "Acor"

);
