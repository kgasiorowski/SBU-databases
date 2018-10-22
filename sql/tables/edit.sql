


CREATE TABLE IF NOT EXISTS edit (

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    article_ID INTEGER NOT NULL,
    FOREIGN KEY(article_ID) REFERENCES article(ID),

    old_title VARCHAR(20) NOT NULL,
    new_title VARCHAR(20) NOT NULL,

    old_body VARCHAR(256) NOT NULL,
    new_body VARCHAR(256) NOT NULL,
    
    user_ID INTEGER NOT NULL,
    FOREIGN KEY(user_ID) REFERENCES user(ID),

    approved_by_admin_ID INTEGER NOT NULL,    
    FOREIGN KEY(approved_by_admin_ID) REFERENCES admin(ID)

);
