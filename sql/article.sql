CREATE TABLE IF NOT EXISTS article(

    ID INT NOT NULL auto_increment, PRIMARY KEY(ID),
    
    filmID INT, FOREIGN KEY(filmID) REFERENCES film(ID),
    personnelID INT, FOREIGN KEY(personnelID) REFERENCES personnel(ID),
    isFilm BOOLEAN NOT NULL, -- Film -> true, Person -> false

    original_author_id INT NOT NULL, FOREIGN KEY(original_author_id) REFERENCES user(ID),

    title VARCHAR(20) NOT NULL,
    body VARCHAR(256) NOT NULL

);
