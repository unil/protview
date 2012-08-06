DROP TABLE IF EXISTS regions;
CREATE TABLE regions (
    id INT NOT NULL AUTO_INCREMENT,
    name TEXT COLLATE utf8_unicode_ci NOT NULL,
    type VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
    start INT NOT NULL,
    end INT NOT NULL,
    pos INT NOT NULL,
    peptide_id INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;