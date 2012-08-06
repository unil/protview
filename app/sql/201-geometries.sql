DROP TABLE IF EXISTS geometries;
CREATE TABLE geometries (
    id INT NOT NULL AUTO_INCREMENT,
    type VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    params TEXT COLLATE utf8_unicode_ci,
    order INT NOT NULL,
    representation_id INT NOT NULL,
    region_id INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;