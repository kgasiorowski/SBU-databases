/*

This table represents a film personnel, in other words, a person that works on films in some form.

The table has several fields which describe any human person (name, birthdate, height).

The tale also has two triggers that validate the person's gender on INSERTs and UPDATEs, respectively.

*/
CREATE TABLE IF NOT EXISTS personnel(

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    firstname CHAR(20) NOT NULL,
    midname CHAR(20),
    lastname CHAR(20) NOT NULL,

    gender CHAR(1),
    birthdate DATE,
    description VARCHAR(64),
    height SMALLINT
   
);

DELIMITER $

CREATE TRIGGER validate_gender_insert BEFORE INSERT ON personnel
    FOR EACH ROW
    BEGIN
        IF  NEW.gender <> "M" AND
            NEW.gender <> "F" AND
            NEW.gender <> "Z"
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Invalid gender set';
        END IF;
END$

CREATE TRIGGER validate_gender_update BEFORE UPDATE ON personnel
    FOR EACH ROW
    BEGIN
        IF  NEW.gender <> "M" AND
            NEW.gender <> "F" AND
            NEW.gender <> "Z"
        THEN
            SIGNAL SQLSTATE '45000' SET message_text = 'Invalid gender set';
        END IF;
END$

DELIMITER ;
