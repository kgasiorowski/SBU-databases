/*

This table represents a film personnel, in other words, a person that works on films in some form.

The table has several fields which describe any human person (name, birthdate, height).

The tale also has two triggers that validate the person's gender on INSERTs and UPDATEs, respectively.

*/
CREATE TABLE IF NOT EXISTS personnel(

    ID INTEGER NOT NULL auto_increment,
    PRIMARY KEY(ID),

    firstname CHAR(20) NOT NULL,
    midname CHAR(20),
    lastname CHAR(20) NOT NULL,

    gender ENUM("M", "F", "Z") NOT NULL,

    birthdate DATE,
    description VARCHAR(64),
    height SMALLINT
   
);
