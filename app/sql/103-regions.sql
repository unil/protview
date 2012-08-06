DROP TABLE IF EXISTS regions;
CREATE TABLE regions (
    id INT NOT NULL AUTO_INCREMENT,
    peptide_id INT NOT NULL,
    label TEXT COLLATE utf8_unicode_ci,
    type VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
    pos INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;