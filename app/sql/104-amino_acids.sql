DROP TABLE IF EXISTS amino_acids;
CREATE TABLE amino_acids (
    id INT NOT NULL AUTO_INCREMENT,
    type VARCHAR(1) COLLATE utf8_unicode_ci NOT NULL,
    modification VARCHAR(20) COLLATE utf8_unicode_ci,
    link INT,
    pos INT NOT NULL,
    region_id INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;