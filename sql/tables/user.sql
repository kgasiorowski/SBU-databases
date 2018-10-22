/*

This table represents a user which can log in to the system to edit or create articles.

Each user has a username stored as a string, and each user's username is unique.


*/
CREATE TABLE IF NOT EXISTS user(

    ID INTEGER NOT NULL auto_increment, PRIMARY KEY(ID),
    
    username VARCHAR(20) NOT NULL,
    password BINARY(16) NOT NULL,

    unique(username)
    

);
