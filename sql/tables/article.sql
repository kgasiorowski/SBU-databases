/*

This tables represents an article on the imdb website.

It has an unique ID.
It has either a personnel or a film linked to it, but not both.
If isFilm is true, then the article describes a film. If not, then it describes a person.

The original author's ID is saved in original_author_id.

The article's title and boy content are saved below that.

TODO- Add trigger to prevent change of original_author_id

*/
CREATE TABLE IF NOT EXISTS article(

    ID INT NOT NULL auto_increment, PRIMARY KEY(ID),
    
    filmID INT, FOREIGN KEY(filmID) REFERENCES film(ID),
    personnelID INT, FOREIGN KEY(personnelID) REFERENCES personnel(ID),
    isFilm BOOLEAN NOT NULL, -- Film -> true, Person -> false

    original_author_id INT NOT NULL, FOREIGN KEY(original_author_id) REFERENCES user(ID),

    title VARCHAR(20) NOT NULL,
    body VARCHAR(256) NOT NULL

);
