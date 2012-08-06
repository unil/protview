DROP TABLE IF EXISTS peptides;
CREATE TABLE peptides (
    id INT NOT NULL AUTO_INCREMENT,
    subunit_id INT NOT NULL,
    label TEXT COLLATE utf8_unicode_ci NOT NULL,
    pos INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;