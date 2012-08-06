DROP TABLE IF EXISTS subunits;
CREATE TABLE subunits (
    id INT NOT NULL AUTO_INCREMENT,
    name TEXT COLLATE utf8_unicode_ci NOT NULL,
    order INT NOT NULL,
    protein_id INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;