<?php
require_once(dirname(__file__).'/../../lib/protview/xfm/Bootstrap.php');

$b = new Bootstrap();

require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/Line.php');

$scatterSize = 20;

$line = new Line($scatterSize);
$line->setRotation(array('sens' => -1, 'angle' => -165));
$line->setNbPoints(10);

require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/Circle.php');

$circle = new Circle($scatterSize);
//$circle->setRotation(array('sens' => -1, 'angle' => 180));
$circle->setNbPoints(7);


require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/StandardLoop.php');
$standardLoop = new StandardLoop($scatterSize);
$standardLoop->setSideLength(8);
$standardLoop->setMiddleLength(8);

require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/ExtendedLoop.php');
$extendedLoop = new ExtendedLoop($scatterSize);
$extendedLoop->setRotation(array('sens' => 1));
$extendedLoop->setBasicLoopSideLength(8);
$extendedLoop->setExtendLoopSideLength(7);
$extendedLoop->setExtendLoopSideMiddleLength(4);
$extendedLoop->setNbExtendLoop(3);

require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/MembranePattern.php');
$membranePattern = new MembranePattern($scatterSize);
$membranePattern->setLength(25);
$membranePattern->setMaxLineLength(6);
$membranePattern->setRotation(array('sens' => 1, 'angle' => 345));

require_once(xContext::$basepath.'/lib/protview/protview/graph/SVGGraphics.php');

$svgGraphics = new SVGGraphics();
header("Content-type: image/svg+xml");
echo '<?xml version="1.0"?>';
echo '<?xml-stylesheet href="../a/css/protein.css" type="text/css" title="Default CSS" media="screen" charset="utf-8"?>';
echo '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink"
width="100%" height="100%" xml:lang="fr">';
$coords = $extendedLoop->getCoord();

foreach ($coords as $k => $v) {
	$x = $v["x"] + 380;
	$y = $v["y"] + 380;
	echo $svgGraphics->drawAminoAcid($x, $y, $scatterSize, "L", $k+1);
}



echo '</svg>';

?>