<?php 
/*Only executed for test purpose in non production environment */
if (xContext::$profile != 'production') { ?>

INSERT INTO `proteins`(id, name, species, note) VALUES (1,'protein 1', null, ''),(2,'protein 2', null, null);

<?php } ?>