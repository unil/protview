<?php 
/*Only executed for test purpose in non production environment */
if (xContext::$profile != 'production') { ?>

INSERT INTO `proteins`(id, name, species, note) VALUES 
	(1,'protein 1', null, ''),(2,'protein 2', null, null);
INSERT INTO `subunits`(id, protein_id, label, pos) VALUES 
	(1,1,'Subunit 1', 1);
INSERT INTO `peptides`(id, subunit_id, label, pos) VALUES 
	(1,1,'Peptide 1', 1);
INSERT INTO `regions`(id, peptide_id, label, type, pos) VALUES 
	(1,1, null, 'extra',1),
	(2,1, null, 'membrane', 2);
INSERT INTO `amino_acids`(region_id, type, pos) VALUES 
	(1, 'a', 1),
	(1, 'b', 2),
	(1, 'c', 3),
	(1, 'd', 4),
	(1, 'e', 5),
	(1, 'f', 6),
	(1, 'g', 7),
	(1, 'h', 8),
	(1, 'i', 9),
	(1, 'j', 10),
	(1, 'k', 11),
	(1, 'l', 12),
	(1, 'm', 13),
	(1, 'n', 14),
	(1, 'o', 15),
	(1, 'p', 16),
	(1, 'q', 17),
	(1, 'r', 18);
INSERT INTO `representations`(id, peptide_id,title, description) VALUES 
	(1, 1, 'My first representation', 'description 1');
INSERT INTO `structural_geometries`(id, representation_id, region_id,type, params, pos) VALUES 
	(1, 1, 1, 'line', null,1),
	(2, 1, 1, 'circle', null,2),
	(3, 1, 1, 'line', null,3);
INSERT INTO `structural_coordinates`(id, structural_geometry_id, amino_acid_id, coordinate) VALUES 
	(1, 1, 1, '80.3/20.2345'),
	(2, 1, 2, '90.3/20.2345'),
	(3, 1, 3, '100.234/20.2345');
INSERT INTO `other_geometries`(id, representation_id, type, params, coordinate, pos) VALUES 
	(1, 1, 'circle', null, '1.23/2435.2345',1);
<?php }?>