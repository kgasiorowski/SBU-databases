-- Delete everything
source delete.sql;

-- Main tables
source personnel.sql;
source film.sql;

-- Junction table to create an interface between film + personnel
source credit.sql;


-- Now administrative tables
source user.sql;
source admin.sql;
source article.sql;
