DROP TABLE IF EXISTS representations;
CREATE TABLE representations (
    id INT NOT NULL AUTO_INCREMENT,
    peptide_id INT NOT NULL,
    title TEXT COLLATE utf8_unicode_ci,
    description TEXT COLLATE utf8_unicode_ci,
    params TEXT COLLATE utf8_unicode_ci,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;