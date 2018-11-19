/*

This script inserts a bunch of sample data into the database.

*/

-- Clear everything
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE credit;
TRUNCATE TABLE personnel;
TRUNCATE TABLE film;
TRUNCATE TABLE user;
TRUNCATE TABLE admin;
TRUNCATE TABLE article;
TRUNCATE TABLE gender;
TRUNCATE TABLE genre;
SET FOREIGN_KEY_CHECKS = 1;

-- Add some values to our side tables
source populate/populate_gender.sql
source populate/populate_genre.sql

-- Add some values to film
source populate/populate_film.sql;

-- Add some values to personnel
source populate/populate_personnel.sql;

-- Add some credits, linking the two tables together
source populate/populate_credit.sql;

-- Add some users
source populate/populate_user.sql;

-- Create some admin accounts
source populate/populate_admin.sql;

-- Create some articles
source populate/populate_article.sql;

-- Create some article edits
source populate/populate_edit.sql;
