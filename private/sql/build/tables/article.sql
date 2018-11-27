/*

This tables represents an article on the imdb website.

It has an unique ID.
It has either a personnel or a film linked to it, but not both.
If isFilm is true, then the article describes a film. If not, then it describes a person.

The original author's ID is saved in original_author_id.

The article's title and boy content are saved below that.

*/
CREATE TABLE IF NOT EXISTS article(

    ID INT NOT NULL auto_increment, PRIMARY KEY(ID),
    
    filmID INT, FOREIGN KEY(filmID) REFERENCES film(ID),
    personnelID INT, FOREIGN KEY(personnelID) REFERENCES personnel(ID),
    isFilm BOOLEAN NOT NULL, -- Film -> true, Person -> false

    original_author_id INT NOT NULL, FOREIGN KEY(original_author_id) REFERENCES user(ID),

    title VARCHAR(64) NOT NULL,
    body VARCHAR(256) NOT NULL,
	imageName VARCHAR(64)
	
);

DELIMITER $

CREATE TRIGGER validate_article_type_insert BEFORE INSERT ON article
    FOR EACH ROW 
    BEGIN
        IF (NEW.filmID IS NULL AND NEW.personnelID IS NULL) OR 
           (NEW.filmID IS NOT NULL AND NEW.personnelID IS NOT NULL) 
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Error: Article cannot be both film and personnel or neither';
        END IF;
END$

CREATE TRIGGER validate_article_type_update BEFORE UPDATE ON article
    FOR EACH ROW 
    BEGIN
        IF (NEW.filmID IS NOT NULL AND NEW.personnelID IS NOT NULL) OR 
           (NEW.filmID IS NULL AND NEW.personnelID IS NULL) 
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Error: Article cannot be both film and personnel or neither';
        END IF;
END$


CREATE TRIGGER validate_isFilm_insert BEFORE INSERT ON article
    FOR EACH ROW
    BEGIN
        IF (NEW.filmID IS NULL AND NEW.isFilm IS TRUE) OR
           (NEW.filmID IS NOT NULL AND NEW.isFilm IS FALSE) OR
           (NEW.personnelID IS NOT NULL AND NEW.isFilm IS TRUE) OR
           (NEW.personnelID IS NULL AND NEW.isFilm IS FALSE)
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Error: Iff the article is a film, isFilm must be true';
        END IF;
END$

CREATE TRIGGER validate_isFilm_update BEFORE UPDATE ON article
    FOR EACH ROW
    BEGIN
        IF (NEW.filmID IS NULL AND NEW.isFilm IS TRUE) OR
           (NEW.filmID IS NOT NULL AND NEW.isFilm IS FALSE) OR
           (NEW.personnelID IS NOT NULL AND NEW.isFilm IS TRUE) OR
           (NEW.personnelID IS NULL AND NEW.isFilm IS FALSE)
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Error: Iff the article is a film, isFilm must be true';
        END IF;
END$       

DELIMITER ;
