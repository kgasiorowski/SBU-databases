DROP USER IF EXISTS 'imdbc_frontend'@'localhost';

CREATE USER 'imdbc_frontend'@'localhost' IDENTIFIED BY 'frontend_password';
GRANT SELECT, INSERT, UPDATE ON imdbc.creditv TO 'imdbc_frontend'@'localhost';
GRANT SELECT, INSERT, UPDATE ON imdbc.articlev TO 'imdbc_frontend'@'localhost';
GRANT SELECT, INSERT, UPDATE ON imdbc.filmv TO 'imdbc_frontend'@'localhost';
GRANT SELECT, INSERT, UPDATE ON imdbc.adminv TO 'imdbc_frontend'@'localhost';
GRANT SELECT, INSERT, UPDATE ON imdbc.userv TO 'imdbc_frontend'@'localhost';
GRANT SELECT, INSERT, UPDATE ON imdbc.personnelv TO 'imdbc_frontend'@'localhost';
GRANT SELECT, INSERT, UPDATE ON imdbc.editv TO 'imdbc_frontend'@'localhost';
GRANT SELECT, INSERT, UPDATE ON imdbc.article TO 'imdbc_frontend'@'localhost';
GRANT SELECT, INSERT, UPDATE ON imdbc.genrev TO 'imdbc_frontend'@'localhost';
GRANT SELECT, INSERT, UPDATE ON imdbc.ratingv TO 'imdbc_frontend'@'localhost';