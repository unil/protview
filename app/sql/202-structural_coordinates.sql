DROP TABLE IF EXISTS structural_coordinates;
CREATE TABLE structural_coordinates (
    id INT NOT NULL AUTO_INCREMENT,
    structural_geometry_id INT NOT NULL,
    amino_acid_id INT NOT NULL,
    coordinate TEXT NOT NULL,
    pos INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;