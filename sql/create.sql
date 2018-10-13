USE IMDB_clone;

-- Delete everything
DROP TABLE IF EXISTS 
    credit,
    film,
    personnel,
    rating,
    genre;

-- Secondary tables first
-- Create table of ratings. Mostly static
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

-- Create table of genres. Also mostly static
CREATE TABLE IF NOT EXISTS genre(

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    Genre CHAR(20),
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

-- Main tables
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
    
    UNIQUE(firstname, midname, lastname),
    UNIQUE(description)

);
CREATE TABLE IF NOT EXISTS film(

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    title CHAR(30) NOT NULL,
    rating INTEGER, FOREIGN KEY(rating) REFERENCES rating(ID),   
    score FLOAT,
    genre INTEGER, FOREIGN KEY(genre) REFERENCES genre(ID),
    date_released DATE DEFAULT "2000-01-01",
    duration_in_minutes FLOAT DEFAULT 120,
    language CHAR(20),
    description VARCHAR(64),

    unique(title, date_released)

);
DELIMITER $
CREATE TRIGGER validate_score BEFORE INSERT ON film
    FOR EACH ROW
    BEGIN
        IF NEW.score < 0 OR
           NEW.score > 10
        THEN
            SIGNAL sqlstate '45000' SET message_text = 'Invalid score set';
        END IF;
    END$
DELIMITER ;

-- Junction table
CREATE TABLE IF NOT EXISTS credit(

    ID INTEGER NOT NULL auto_increment, 
    PRIMARY KEY(ID),

    personnel_ID INTEGER NOT NULL, 
    FOREIGN KEY(personnel_ID) REFERENCES personnel(ID),

    film_ID INTEGER NOT NULL,
    FOREIGN KEY(film_ID) REFERENCES film(ID),

    credit_type CHAR(30) NOT NULL 

);
DELIMITER $
CREATE TRIGGER validate_credit_type BEFORE INSERT ON credit
    FOR EACH ROW
    BEGIN
        IF  NEW.credit_type <> 'Acting' AND 
            NEW.credit_type <> 'Directing' AND 
            NEW.credit_type <> 'Producing'
        THEN 
            SIGNAL sqlstate '45000' SET message_text = 'Bad credit type';
        END IF;
    END$
DELIMITER ;
