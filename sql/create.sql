-- Delete everything
source delete.sql;

-- Create table of film roles. Mostly static
/*
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
*/

-- Main tables
source personnel.sql;
source film.sql;

-- Junction table to create an interface between film + personnel
source credit.sql;
