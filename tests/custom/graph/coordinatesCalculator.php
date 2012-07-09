<?php

require_once(xContext::$basepath.'/lib/protview/protview/graph/SVGGraphics.php');
require_once(xContext::$basepath.'/lib/protview/protview/calc/CoordinatesCalculator.php');

header("Content-type: image/svg+xml");
echo '<?xml version="1.0"?>';
echo '<?xml-stylesheet href="../a/css/protein.css" type="text/css" title="Default CSS" media="screen" charset="utf-8"?>';
echo '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink"
width="100%" height="100%" xml:lang="fr">';



$membraneX = 0;
$membraneY = 300;
$membraneWidth = 1200;
$membraneHeight = 100;

//number of aa
$length = 24;
$size = 18;

$startCoord = array("x" => 0, "y" => 0);
$coords = array();

$svgGraphics = new SVGGraphics();

echo $svgGraphics->drawMembrane($membraneX, $membraneY, $membraneWidth, $membraneHeight);

$coordinatesCalculator = new CoordinatesCalculator($size, $startCoord);
//left
$coordinatesCalculator->setSequenceLength(5);
$coord = $coordinatesCalculator->calculateLine();
$coords = array_merge($coords, $coord);
	
//middle
$coordinatesCalculator->setSequenceLength(10);
$endCoord = $coordinatesCalculator->getEndCoord();
	
$endCoord['y'] -= $size;
$coordinatesCalculator->setStartCoord($endCoord);
$coord = $coordinatesCalculator->calculateArc();
$coords = array_merge($coords, $coord);
	
//right
$coordinatesCalculator->setSequenceLength(5);
$endCoord = $coordinatesCalculator->getEndCoord();
$coordinatesCalculator->setStartCoord($endCoord);
$coord = $coordinatesCalculator->calculateLine(-1);
$coords = array_merge($coords, $coord);
	
//left
$coordinatesCalculator->setSequenceLength(15);
$endCoord = $coordinatesCalculator->getEndCoord();
$coordinatesCalculator->setStartCoord($endCoord);
$coord = $coordinatesCalculator->calculateLine(-1);
$coords = array_merge($coords, $coord);
	
//middle
$coordinatesCalculator->setSequenceLength(3);
$endCoord = $coordinatesCalculator->getEndCoord();
	
$endCoord['y'] += $size;
$coordinatesCalculator->setStartCoord($endCoord);
$coord = $coordinatesCalculator->calculateArc(-1);
$coords = array_merge($coords, $coord);
	
//right
$coordinatesCalculator->setSequenceLength(15);
$endCoord = $coordinatesCalculator->getEndCoord();
$coordinatesCalculator->setStartCoord($endCoord);
$coord = $coordinatesCalculator->calculateLine();
$coords = array_merge($coords, $coord);
	
//membrane
$coordinatesCalculator->setSequenceLength(4);
$endCoord = $coordinatesCalculator->getEndCoord();
$coordinatesCalculator->setStartCoord($endCoord);
$coord = $coordinatesCalculator->calculateLine(1, 165);
$coords = array_merge($coords, $coord);
	
$endCoord['y'] -= $size;
$coordinatesCalculator->setStartCoord($endCoord);
$coord = $coordinatesCalculator->calculateLine(1, 165);
$coords = array_merge($coords, $coord);
	
$endCoord['x'] += $size;
$endCoord['y'] -= $size;
$coordinatesCalculator->setStartCoord($endCoord);
$coord = $coordinatesCalculator->calculateLine(1, 165);
$coords = array_merge($coords, $coord);
	
$endCoord['x'] -= $size;
$endCoord['y'] -= $size;
$coordinatesCalculator->setStartCoord($endCoord);
$coord = $coordinatesCalculator->calculateLine(1, 165);
$coords = array_merge($coords, $coord);
	
$endCoord['x'] += $size;
$endCoord['y'] -= $size;
$coordinatesCalculator->setStartCoord($endCoord);
$coord = $coordinatesCalculator->calculateLine(1, 165);
$coords = array_merge($coords, $coord);

//drawing
foreach ($coords as $k => $v) {
	$x = $v["x"] + 80;
	$y = $v["y"] + 358;
	echo $svgGraphics->drawAminoAcid($x, $y, $size, "L", $k);
}
echo '</svg>';
?>