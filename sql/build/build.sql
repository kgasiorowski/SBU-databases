/*

Main building file. You can run this file from mysql in order to create the 
table structure. This script just deletes anything that exists and
re-creates the tables one by one.

*/

-- Delete everything
source delete.sql;

-- Main tables
source ../tables/personnel.sql;
source ../tables/film.sql;

-- Junction table to create an interface between film + personnel
source ../tables/credit.sql;


-- Now administrative tables
source ../tables/user.sql;
source ../tables/admin.sql;
source ../tables/article.sql;
source ../tables/edit.sql



-- Now create the procedures
source procs.sql;
