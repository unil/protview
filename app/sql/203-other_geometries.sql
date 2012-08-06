DROP TABLE IF EXISTS other_geometries;
CREATE TABLE other_geometries (
    id INT NOT NULL AUTO_INCREMENT,
    type VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    params TEXT COLLATE utf8_unicode_ci,
    pos INT NOT NULL,
    coordinate TEXT NOT NULL,
    representation_id INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;