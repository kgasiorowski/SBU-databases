-- Table that holds admin info
CREATE TABLE IF NOT EXISTS admin(

    ID INTEGER NOT NULL auto_increment, PRIMARY KEY(ID),

    userID INTEGER NOT NULL, FOREIGN KEY (userID) REFERENCES user(ID)


);
