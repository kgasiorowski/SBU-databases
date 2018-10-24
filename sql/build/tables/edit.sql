/*

This table represents an edit made to an article.

*/


CREATE TABLE IF NOT EXISTS edit (

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    article_ID INTEGER NOT NULL, --  Which article was edited
    FOREIGN KEY(article_ID) REFERENCES article(ID),

    time_of_edit DATETIME NOT NULL DEFAULT NOW(), -- The date and time of the edit
    time_of_approval DATETIME DEFAULT NULL, -- The date and time that this edit was approved (may be never)

    -- The old content
    old_title VARCHAR(20) NOT NULL, 
    new_title VARCHAR(20) NOT NULL,

    -- The new content
    old_body VARCHAR(256) NOT NULL,
    new_body VARCHAR(256) NOT NULL,
    
    -- Which user submitted the edit
    user_ID INTEGER NOT NULL,
    FOREIGN KEY(user_ID) REFERENCES user(ID),

    -- Which admin approved it
    approved_by_admin_ID INTEGER DEFAULT NULL,    
    FOREIGN KEY(approved_by_admin_ID) REFERENCES admin(ID)

);
