DROP TABLE IF EXISTS proteins;
CREATE TABLE proteins (
    id INT NOT NULL AUTO_INCREMENT,
    name TEXT COLLATE utf8_unicode_ci NOT NULL,
    species VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    nonte TEXT COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;