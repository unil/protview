DROP TABLE IF EXISTS coordinates;
CREATE TABLE coordinates (
    id INT NOT NULL AUTO_INCREMENT,
    x DOUBLE NOT NULL,
    y DOUBLE NOT NULL,
    order INT NOT NULL,
    geometry_id INT NOT NULL,
    amino_acid_id INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;