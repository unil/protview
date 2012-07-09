<?php

function getRad($deg) {
	return $deg * M_PI / 180;
}

function getDeg($arg) {
	return $arg*180/pi();
}

/*
$deg = 89;

$rad = getRad($deg);

$oc = cos($rad);

$cm = sin($rad);

echo "Angle: {$deg} <br /> OC: {$oc} <br /> OS: {$cm}";


$angle = getDeg(atan2(($y2 - $y1), ($x2 - $x1)));*/



/**
 * (x,y) is current point
(cx,cy) is pivot point to rotate
=a= is angle in degrees

$_rotation     = 1;      # -1 = counter, 1 = clockwise
$_precision    = 2;      # two decimal places
*/
function returnRotatedPoint($x,$y,$cx,$cy,$a)
{
// http://mathforum.org/library/drmath/view/63184.html
	//global $_rotation;     # -1 = counter, 1 = clockwise
    //global $_precision;    # two decimal places
    $_rotation = 1;
    $_precision = 0;


// radius using distance formula
$r = sqrt(pow(($x-$cx),2)+pow(($y-$cy),2));
// initial angle in relation to center
$iA = $_rotation * rad2deg(atan2(($y-$cy),($x-$cx)));

$nx = number_format($r * cos(deg2rad($_rotation * $a + $iA)),$_precision);
$ny = number_format($r * sin(deg2rad($_rotation * $a + $iA)),$_precision);

return array("x"=>$cx+$nx,"y"=>$cy+$ny);
}
?>