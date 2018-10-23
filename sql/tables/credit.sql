/*

This table represents every film credit every personnel has ever had.

This table is somewhat more complex, as it links two tables together in a 
many-to-many relationship.

Each credit has a unique ID, the ID of some personnel, and the ID of some film.
Also, it as a role, which is validated by the triggers defined  below the table.


*/
CREATE TABLE IF NOT EXISTS credit(

    ID INTEGER NOT NULL auto_increment, 
    PRIMARY KEY(ID),

    personnelID INTEGER NOT NULL, 
    FOREIGN KEY(personnelID) REFERENCES personnel(ID),

    filmID INTEGER NOT NULL,
    FOREIGN KEY(filmID) REFERENCES film(ID),

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
