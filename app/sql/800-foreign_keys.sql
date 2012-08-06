ALTER TABLE `subunits`
  ADD CONSTRAINT `protein_fk` FOREIGN KEY (`protein_id`) REFERENCES `proteins` (`id`);
  
ALTER TABLE `peptides`
  ADD CONSTRAINT `subunit_fk` FOREIGN KEY (`subunit_id`) REFERENCES `subunits` (`id`);
  
ALTER TABLE `regions`
  ADD CONSTRAINT `peptide_fk` FOREIGN KEY (`peptide_id`) REFERENCES `peptides` (`id`);

ALTER TABLE `amino_acids`
  ADD CONSTRAINT `region_fk` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);
  
ALTER TABLE `representations`
  ADD CONSTRAINT `peptide_fk` FOREIGN KEY (`peptide_id`) REFERENCES `peptides` (`id`);

ALTER TABLE `geometries`
  ADD CONSTRAINT `representation_fk` FOREIGN KEY (`representation_id`) REFERENCES `representations` (`id`);
  ADD CONSTRAINT `region_fk` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);

ALTER TABLE `coordinates`
  ADD CONSTRAINT `geometry_fk` FOREIGN KEY (`geometry_id`) REFERENCES `geometries` (`id`);
  ADD CONSTRAINT `amino_acid_fk` FOREIGN KEY (`amino_acid_id`) REFERENCES `amino_acids` (`id`);