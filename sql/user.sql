-- Table that holds all the user info
CREATE TABLE IF NOT EXISTS user(

    ID INTEGER NOT NULL auto_increment, PRIMARY KEY(ID),
    
    username VARCHAR(20) NOT NULL,
    password BINARY(16) NOT NULL
    

);
