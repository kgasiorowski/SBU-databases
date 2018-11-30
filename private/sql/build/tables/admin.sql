/*

This table represents the admins present on the website.
Each admin is a user, so the corresponding user ID is a foreign key.

*/

CREATE TABLE IF NOT EXISTS admin(

    ID INTEGER NOT NULL auto_increment, 
	PRIMARY KEY(ID),
    
	userID INTEGER NOT NULL, 
	FOREIGN KEY (userID) REFERENCES user(ID)

);
