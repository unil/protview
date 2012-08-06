DROP TABLE IF EXISTS subunits;
CREATE TABLE subunits (
    id INT NOT NULL AUTO_INCREMENT,
    protein_id INT NOT NULL,
    label TEXT COLLATE utf8_unicode_ci NOT NULL,
    pos INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;