DROP TABLE IF EXISTS representations;
CREATE TABLE representations (
    id INT NOT NULL AUTO_INCREMENT,
    title TEXT COLLATE utf8_unicode_ci,
    description TEXT COLLATE utf8_unicode_ci,
    subunit_id INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;