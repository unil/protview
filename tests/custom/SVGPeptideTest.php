<?php

require_once(xContext::$basepath.'/lib/protview/protview/graph/SVGGraphics.php');
require_once(xContext::$basepath.'/lib/protview/protview/bio/Peptide.php');
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/PeptideShape.php');


$offsetX = 80;
$offsetY = 380;

//number of aa
$length = 24;
$size = 20;

$startCoord = array("x" => 0, "y" => 0);

$svgGraphics = new SVGGraphics();


/*Create protein test*/
$sequence = "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";

$regions = array(
		array('start' => 1, 'end' => 17, 'type' => 'intra'),
		array('start' => 18, 'end' => 36, 'type' => 'membrane'),
		array('start' => 37, 'end' => 57, 'type' => 'extra'),
		array('start' => 58, 'end' => 78, 'type' => 'membrane'),
		array('start' => 79, 'end' => 120, 'type' => 'intra'),
		array('start' => 121, 'end' => 150, 'type' => 'membrane'),
		array('start' => 151, 'end' => 300, 'type' => 'extra'),
		array('start' => 301, 'end' => 318, 'type' => 'membrane'),
		array('start' => 319, 'end' => 340, 'type' => 'intra'),
		array('start' => 341, 'end' => 360, 'type' => 'membrane'),
		array('start' => 361, 'end' => 380, 'type' => 'extra'),
		array('start' => 381, 'end' => 410, 'type' => 'membrane'),
		array('start' => 411, 'end' => 431, 'type' => 'intra'),
		array('start' => 432, 'end' => 450, 'type' => 'membrane'),
		array('start' => 451, 'end' => 480, 'type' => 'extra')
);

//Create peptide
$peptide = new Peptide(1, 1, 110);

//Initialize amino acid counter (id)
$count = 1;
//Reade sequence and create amino acid class for each value
//increases id by one for each amino acid
//adds amino acids to a domain

$elements = str_split($sequence);

for ($d = 0; $d < count($regions); $d++) {
	$dom = $regions[$d];

	$start = $dom['start'];
	$end = $dom['end'];
	$type = $dom['type'];

	$region = new Region($d+1, $start, $end, $type);

	for ($s = $start; $s <= $end; $s++) {
		$region->addAminoAcid(new AminoAcid($s, $elements[$s]));
		$count++;
	}
	$peptide->addRegion($region);

}

$proteinCalc = new PeptideShape($peptide, $startCoord, $size);

$coords = $proteinCalc->getAACoordinates();
$membraneCoords = $proteinCalc->getMembraneCoordinates();

$params = $proteinCalc->getParams();

$height = $params['maxY'] - $params['minY'];
$width = $params['maxX'] - $params['minX'];

$minX = $params['minX'];
$minY = $params['minY'];
$maxY = $params['maxY'];

header("Content-type: image/svg+xml");
echo '<?xml version="1.0"?>';
echo '<?xml-stylesheet href="../a/css/protein.css" type="text/css" title="Default CSS" media="screen" charset="utf-8"?>';
echo '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink"
width="'. $width. '" height="'. $height .'" xml:lang="fr"
preserveAspectRatio="xMinYMin meet"
viewBox="' . $minX . ' ' . $minY . ' 1000 800">';


echo $svgGraphics->drawMembrane($minX, $membraneCoords['minY'], $width, $membraneCoords['maxY']-$membraneCoords['minY']);

//xContext::$log->log(array('coords', $coords), 'protein');

//drawing
foreach ($coords as $k => $v) {
	$x = $v["x"];
	$y = $v["y"];
	echo $svgGraphics->drawAminoAcid($x, $y, $size, $elements[$k], $k+1);
}

echo '</svg>';
?>