ALTER TABLE `subunits`
  ADD CONSTRAINT `subunits_protein_fk` FOREIGN KEY (`protein_id`) REFERENCES `proteins` (`id`);
  
ALTER TABLE `peptides`
  ADD CONSTRAINT `peptides_subunit_fk` FOREIGN KEY (`subunit_id`) REFERENCES `subunits` (`id`) ON DELETE CASCADE;
  
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_peptide_fk` FOREIGN KEY (`peptide_id`) REFERENCES `peptides` (`id`) ON DELETE CASCADE;

ALTER TABLE `amino_acids`
  ADD CONSTRAINT `amino_acids_region_fk` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;
  
ALTER TABLE `representations`
  ADD CONSTRAINT `representations_peptide_fk` FOREIGN KEY (`peptide_id`) REFERENCES `peptides` (`id`) ON DELETE CASCADE;

ALTER TABLE `structural_geometries`
  ADD CONSTRAINT `structural_geometries_representation_fk` FOREIGN KEY (`representation_id`) REFERENCES `representations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `structural_geometries_region_fk` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

ALTER TABLE `structural_coordinates`
  ADD CONSTRAINT `structural_coordinates_structural_geometry_fk` FOREIGN KEY (`structural_geometry_id`) REFERENCES `structural_geometries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `structural_coordinates_amino_acid_fk` FOREIGN KEY (`amino_acid_id`) REFERENCES `amino_acids` (`id`) ON DELETE CASCADE;
  
ALTER TABLE `other_geometries`
  ADD CONSTRAINT `other_geometries_representation_fk` FOREIGN KEY (`representation_id`) REFERENCES `representations` (`id`) ON DELETE CASCADE;