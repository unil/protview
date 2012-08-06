ALTER TABLE `sites`
  ADD CONSTRAINT `prtein_fk` FOREIGN KEY (`protein_id`) REFERENCES `proteins` (`id`);