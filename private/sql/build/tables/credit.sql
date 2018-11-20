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

    roleID INTEGER NOT NULL,
	FOREIGN KEY(roleID) REFERENCES role(ID)

);