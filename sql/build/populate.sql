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
SET FOREIGN_KEY_CHECKS = 1;

-- Add some values to film
source build/populate/populate_film.sql;

-- Add some values to personnel
source build/populate/populate_personnel.sql;

-- Add some credits, linking the two tables together
source build/populate/populate_credit.sql;

-- Add some users
source build/populate/populate_user.sql;

-- Create some admin accounts
source build/populate/populate_admin.sql;

-- Create some articles
source build/populate/populate_article.sql;
