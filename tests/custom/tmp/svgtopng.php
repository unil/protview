<?php
$out = null;

//echo exec('./convert.sh');
passthru('/Applications/Inkscape.app/Contents/Resources/script "/Volumes/FILES/smeier/Sites/protein-visualizer/app/public/protein.svg" --export-png="/Volumes/FILES/smeier/Sites/protein-visualizer/app/public/out/protein.png"2>&1');

//echo var_dump($out);
//header('Content-Type: image/png');
//passthru('cat out/tigre.png');

?>