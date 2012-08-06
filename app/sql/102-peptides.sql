DROP TABLE IF EXISTS peptides;
CREATE TABLE peptides (
    id INT NOT NULL AUTO_INCREMENT,
    protein_id INT NOT NULL,
    name TEXT COLLATE utf8_unicode_ci NOT NULL,
    start INT NOT NULL,
    end INT NOT NULL,
    order INT NOT NULL,
    subunit_id INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
