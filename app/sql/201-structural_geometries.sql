DROP TABLE IF EXISTS structural_geometries;
CREATE TABLE structural_geometries (
    id INT NOT NULL AUTO_INCREMENT,
    representation_id INT NOT NULL,
    region_id INT NOT NULL,
    type VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    params TEXT COLLATE utf8_unicode_ci,
    pos INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;