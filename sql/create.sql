USE IMDB_clone;

-- Delete everything
DROP TABLE IF EXISTS 
    credit,
    film,
    personnel,
    genre,
    role;

-- Secondary tables first
-- Create table of ratings. Mostly static
/*
CREATE TABLE IF NOT EXISTS rating(

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    rating CHAR(5),
    UNIQUE(rating)

);

INSERT INTO rating (rating) 
    VALUES
    ('NYR'), -- Not yet rated
    ('UR'),  -- Unrated
    ('G'),
    ('PG'),
    ('PG-13'),
    ('R'),
    ('NC-17');
*/
-- Create table of genres. Also mostly static
CREATE TABLE IF NOT EXISTS genre(

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    genre CHAR(20),
    UNIQUE(genre)

);

INSERT INTO genre (genre)
    VALUES
    ('No Genre'),
    ('Drama'),
    ('Romance'),
    ('Comedy'),
    ('Animation'),
    ('Horror'),
    ('Action'),
    ('Thriller'),
    ('Western'),
    ('Documentary'),
    ('Mystery'),
    ('Science Fiction'),
    ('Romantic Comedy');

-- Create table of film roles. Mostly static
CREATE TABLE IF NOT EXISTS role(

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),
    
    role CHAR(20),
    UNIQUE(role)

);

INSERT INTO role (role)
    VALUES
    ('Producer'),
    ('Director'),
    ('Actor'),
    ('Screenwriter'),
    ('Editor'),
    ('Cinematographer'),
    ('Musical Composer');

-- Main tables

-- This table holds records for every person to ever work on a film
CREATE TABLE IF NOT EXISTS personnel(

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    firstname CHAR(20) NOT NULL,
    midname CHAR(20),
    lastname CHAR(20) NOT NULL,

    gender CHAR(1),
    birthdate DATE,
    description VARCHAR(64),
    height SMALLINT,
    
    UNIQUE(firstname, midname, lastname)

);

-- This table holds all records for every film
CREATE TABLE IF NOT EXISTS film(

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    title CHAR(30) NOT NULL,
    rating CHAR(5) NOT NULL DEFAULT "NYR",
    score FLOAT,
    genre INTEGER, FOREIGN KEY(genre) REFERENCES genre(ID),
    date_released DATE DEFAULT "2000-01-01",
    duration_in_minutes FLOAT DEFAULT 120,
    language CHAR(20),
    description VARCHAR(64),

    unique(title, date_released)

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

-- Create triggers to validate the rating of a film
CREATE TRIGGER validate_rating_insert BEFORE INSERT ON film
    FOR EACH ROW
    BEGIN
        IF  NEW.rating <> NULL AND
            NEW.rating <> "NYR" AND
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
        IF  NEW.rating <> NULL AND
            NEW.rating <> "NYR" AND
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

-- Junction table. Enables many-to-many relationships to be easily organized
CREATE TABLE IF NOT EXISTS credit(

    ID INTEGER NOT NULL auto_increment, 
    PRIMARY KEY(ID),

    personnel_ID INTEGER NOT NULL, 
    FOREIGN KEY(personnel_ID) REFERENCES personnel(ID),

    film_ID INTEGER NOT NULL,
    FOREIGN KEY(film_ID) REFERENCES film(ID),

    role_ID INTEGER NOT NULL,
    FOREIGN KEY(role_ID) REFERENCES role(ID)

);
