-- Junction table. Enables many-to-many relationships to be easily organized
CREATE TABLE IF NOT EXISTS credit(

    ID INTEGER NOT NULL auto_increment, 
    PRIMARY KEY(ID),

    personnel_ID INTEGER NOT NULL, 
    FOREIGN KEY(personnel_ID) REFERENCES personnel(ID),

    film_ID INTEGER NOT NULL,
    FOREIGN KEY(film_ID) REFERENCES film(ID),

    role char(30) NOT NULL DEFAULT "Actor"

);

DELIMITER $

CREATE TRIGGER validate_role_insert BEFORE INSERT ON credit
    FOR EACH ROW
    BEGIN
        IF  NEW.role <> 'Producer' AND
            NEW.role <> 'Director' AND
            NEW.role <> 'Actor' AND
            NEW.role <> 'Screenwriter' AND
            NEW.role <> 'Editor' AND
            NEW.role <> 'Cinematographer' AND
            NEW.role <> 'Musical Composer'
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Invalid role set';
        END IF;
END$

CREATE TRIGGER validate_role_update BEFORE UPDATE ON credit
    FOR EACH ROW
    BEGIN
        IF  NEW.role <> 'Producer' AND
            NEW.role <> 'Director' AND
            NEW.role <> 'Actor' AND
            NEW.role <> 'Screenwriter' AND
            NEW.role <> 'Editor' AND
            NEW.role <> 'Cinematographer' AND
            NEW.role <> 'Musical Composer'
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Invalid role set';
        END IF;
END$

DELIMITER ;
