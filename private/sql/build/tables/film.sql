/*

This table represents a film.

It has several fields 


*/

CREATE TABLE IF NOT EXISTS film(

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    title CHAR(30) NOT NULL,
    rating CHAR(5) NOT NULL DEFAULT "NYR",
    score FLOAT,
    genre INTEGER, FOREIGN KEY(genre) REFERENCES genre(ID),
    date_released DATE NOT NULL DEFAULT "2000-01-01",
    duration_in_minutes FLOAT NOT NULL DEFAULT 120,
    language CHAR(20),
    description VARCHAR(64),

    UNIQUE(title, date_released)

);


DELIMITER $

-- Create triggers to validate the score of a film
CREATE TRIGGER validate_score_insert BEFORE INSERT ON film
    FOR EACH ROW
    BEGIN
        IF  NEW.score < 0 OR
            NEW.score > 10
        THEN
            SIGNAL sqlstate '45000' SET message_text = 'Invalid score set';
        END IF;
END$

CREATE TRIGGER validate_score_update BEFORE UPDATE ON film
    FOR EACH ROW
    BEGIN
        IF  NEW.score < 0 OR
            NEW.score > 10
        THEN
            SIGNAL sqlstate '45000' SET message_text = 'Invalid score set';
        END IF;
END$ 

-- Create triggers to validate film genre --
/*CREATE TRIGGER validate_film_genre_insert BEFORE INSERT ON film
    FOR EACH ROW
    BEGIN
        IF  NEW.genre <> "No genre" AND
            NEW.genre <> "Drama" AND
            NEW.genre <> "Romance" AND
            NEW.genre <> "Comedy" AND
            NEW.genre <> "Animation" AND
            NEW.genre <> "Horror" AND
            NEW.genre <> "Action" AND
            NEW.genre <> "Thriller" AND
            NEW.genre <> "Western" AND
            NEW.genre <> "Documentary" AND
            NEW.genre <> "Mystery" AND
            NEW.genre <> "Science Fiction" AND
            NEW.genre <> "Romantic Comedy" 
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Invalid genre set';
        END IF;
END$            

CREATE TRIGGER validate_film_genre_update BEFORE UPDATE ON film
    FOR EACH ROW
    BEGIN
        IF  NEW.genre <> "No genre" AND
            NEW.genre <> "Drama" AND
            NEW.genre <> "Romance" AND
            NEW.genre <> "Comedy" AND
            NEW.genre <> "Animation" AND
            NEW.genre <> "Horror" AND
            NEW.genre <> "Action" AND
            NEW.genre <> "Thriller" AND
            NEW.genre <> "Western" AND
            NEW.genre <> "Documentary" AND
            NEW.genre <> "Mystery" AND
            NEW.genre <> "Science Fiction" AND
            NEW.genre <> "Romantic Comedy" 
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Invalid genre set';
        END IF;
END$            
*/
-- Create triggers to validate the rating of a film
CREATE TRIGGER validate_rating_insert BEFORE INSERT ON film
    FOR EACH ROW
    BEGIN
        IF  NEW.rating <> "NYR" AND
            NEW.rating <> "UR" AND
            NEW.rating <> "G" AND
            NEW.rating <> "PG" AND
            NEW.rating <> "PG-13" AND
            NEW.rating <> "R" AND
            NEW.rating <> "NC-17"
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Invalid rating set';
        END IF;
END$

CREATE TRIGGER validate_rating_update BEFORE UPDATE ON film        
    FOR EACH ROW
    BEGIN
        IF  NEW.rating <> "NYR" AND
            NEW.rating <> "UR" AND
            NEW.rating <> "G" AND
            NEW.rating <> "PG" AND
            NEW.rating <> "PG-13" AND
            NEW.rating <> "R" AND
            NEW.rating <> "NC-17"
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Invalid rating set';
        END IF;
END$

DELIMITER ;
