/*

This table represents a film.

It has several fields 


*/

CREATE TABLE IF NOT EXISTS film(

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    title CHAR(30) NOT NULL,
    rating INTEGER NOT NULL DEFAULT 1, FOREIGN KEY(rating) REFERENCES rating(ID),
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

DELIMITER ;