CREATE TABLE ft_table (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    login VARCHAR(8) default 'toto' NOT NULL,
    groupe ENUM('staff','student','other') NOT NULL,
    creation_date DATE NOT NULL
);
