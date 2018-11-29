/*

This table represents a user which can log in to the system to edit or create articles.

Each user has a username stored as a string, and each user's username is unique.

NOTE: Passwords should NEVER be stored as plaintext in a database. Usually you would create a
hash and store that instead, but since that's not the focus of this assignment, the passwords
will be stored as plaintext.

*/
CREATE TABLE IF NOT EXISTS user(

    ID INTEGER NOT NULL auto_increment, PRIMARY KEY(ID),
    
    username VARCHAR(64) NOT NULL,
    password VARCHAR(64) NOT NULL,

    firstName VARCHAR(64),
    lastName VARCHAR(64),

    email VARCHAR(64),

    UNIQUE(username)
    

);
