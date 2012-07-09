<?php

require_once('../lib/protview/protview/CoordinationCalculator');

header("Content-type: image/svg+xml");
echo '<?xml version="1.0"?>';
echo '<?xml-stylesheet href="a/css/protein.css" type="text/css" title="Default CSS" media="screen" charset="utf-8"?>';
echo '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink"
width="100%" height="100%" xml:lang="fr">';

function drawAminoAcid($x, $y, $size, $label, $pos) {
	return "<g id=\"aa-{$pos}\" class=\"aa\" transform=\"translate({$x},{$y})\">
	<circle r=\"". ($size/2) . "\"/>
	<text x=\"-2\" y=\"-2\">{$label}</text>
	<text class=\"seq-num\" x=\"-2\" y=\"6\">{$pos}</text>
	</g>";
}

function drawMembrane($x, $y, $width, $height) {
	$membrane = "";
	$membrane .= "<line x1=\"{$x}\" x2=\"". ($x+$width) . "\" y1=\"". ($y-$height/2) . "\" y2=\"". ($y-$height/2) . "\" style=\"fill:none;stroke:#d83200;stroke-width:2px;\"/>";
	$membrane .= "<line x1=\"{$x}\" x2=\"". ($x+$width) . "\" y1=\"{$y}\" y2=\"{$y}\" style=\"fill:none;stroke:#fab998;stroke-width:". ($height) . "px;\"/>";
	$membrane .= "<line x1=\"{$x}\" x2=\"". ($x+$width) . "\" y1=\"". ($y+$height/2) . "\" y2=\"". ($y+$height/2) . "\" style=\"fill:none;stroke:#d83200;stroke-width:1px;\"/>";
	return $membrane;
}

/**
 *
 * @param int $x
 * @param int $y
 * @param int $diameter
 * @param int $sideLength
 * @param int $totalLength
 * @param boolean $up
 * @return array $coordinates
 */
function getAAPosition($x, $y, $diameter, $sideLength, $totalLength, $up = false) {
	/*
	 * Stores the x,y coordinates of every
	 * amino acid
	 * array(
	 * 	array("x" => posX
	 * 		  "y" => posY),
	 *  array("x" => posX
	 * 		  "y" => posY)
	 * )
	 */
	$coord = array();

	$middleLength = $totalLength-2*$sideLength;

	$middleSide = 0;
	$middle = 1;
	
	$operator = "-=";
	
	if(!$up) {
		$operator = "+=";
	}

	if($middleLength %2 == 0) {
		$middle = 4;
	}

	$middleSide = $middleLength - $middle;

	//left
	for ($nb = 1; $nb <= $sideLength; $nb++) {
		if ($up)
			$y -= $diameter;
		else
			$y += $diameter;
		$coord[] = array("x" => $x, "y" => $y);
	}

	//middle left
	for ($nb = $middleSide; $nb >= 1; $nb--) {
		if ($up)
			$y -= $diameter;
		else
			$y += $diameter;
		$coord[] = array("x" => $x, "y" => $y);
		$x +=$diameter/$nb;
	}

	//middle
	$x -=$diameter;
	if ($up)
		$y -= $diameter;
	else
		$y += $diameter;
	for ($nb = 1; $nb <= $middle; $nb++) {
		$x +=$diameter;
		$coord[] = array("x" => $x, "y" => $y);
	}

	//middle right
	for ($nb = 1; $nb <= $middleSide; $nb++) {
		$x +=$diameter/$nb;
		if ($up)
			$y += $diameter;
		else
			$y -= $diameter;
		$coord[] = array("x" => $x, "y" => $y);
	}

	//right
	for ($nb = 1; $nb <= $sideLength; $nb++) {
		if ($up)
			$y += $diameter;
		else
			$y -= $diameter;
		$coord[] = array("x" => $x, "y" => $y);
	}
	//eval ('$x $operator 1;');
	return $coord;
}
/*
 * périmètre/2 = pi X r

middleLength * size / pi = r

r*2 = espace entre left et right
	
 */
function drawArc() {
	$length = 10;
	$size = 18;
	$coord = array();
	
	$r = $size * $length / M_PI;
	
	$startX = 80;
	$startY = 358;
	$_precision = 0;
	$_rotation = -1;
	
	$offset = 180/$length;
	

	for ($a = 180; $a >= 0; $a -= $offset)	 {
		$nx = number_format($r * cos(deg2rad($_rotation * $a)),$_precision);
		$ny = number_format($r * sin(deg2rad($_rotation * $a)),$_precision);
		
		$coord[] = array("x" => $nx + $startX, "y" => $ny + $startY);
	}
	return $coord;
}
?>


<title>Nom de la protéine</title>
<desc>Description de la protéine</desc>

<?php 

$membraneX = 0;
$membraneY = 300;
$membraneWidth = 1200;
$membraneHeight = 100;

$aminoAcidRadios = 18;
$amionAcidStartX = 80;
$aminoAcidEndX = 80;


echo drawMembrane($membraneX, $membraneY, $membraneWidth, $membraneHeight);

//number of aa
$length = 24;


$size = 18;
$startX = 80;
$startY = 358;

$height = (int)($length/3);
$height = 8;

/*
$pos = getAAPosition($startX, $startY-$size, $size, $height, $length, true);


foreach ($pos as $k => $v) {
	$x = $v["x"];
	$y = $v["y"];
	echo drawAminoAcid($x, $y, $size, "L", $k);
}

$pos = getAAPosition($startX*2, $startY, $size, $height, $length, false);

foreach ($pos as $k => $v) {
$x = $v["x"];
$y = $v["y"];
echo drawAminoAcid($x, $y, $size, "L", $k);
}*/

$pos = drawArc();

foreach ($pos as $k => $v) {
	$x = $v["x"];
	$y = $v["y"];
	echo drawAminoAcid($x, $y, $size, "Q", $k);
}

?>
</svg>
