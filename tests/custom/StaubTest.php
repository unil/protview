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
$sequence = "MAELPVTELPGDALCSGRFTISTLMGGDEPPPAACDSSQPSHLTHGSTLYMRTFGYNTIDVVPAYEHYANSALPGEPRKVRPTLADLHSFLKQEGSHLHALAFDGRQGRELTDGLVEDETGTNSEKSPGEPVRFGWVKGVMIRCMLNIWGVILYLRLPWITAQAGIVLTWLIILLSVMVTSITGLSISAISTNGKVKSGGTYFLISRSLGPELGGSIGLIFAFANAVGVAMHTVGFAETVRDLLQEYGTPIVDPINDIRIIGVVTVTVLLAISLAGMEWESKAQVLFFLVIMVSFANYLVGTLIPASEDKASKGFYSYHGDIFVQNLVPDWRGIDGSFFGMFSIFFPSATGILAGANISGDLKDPAVAIPKGTLMAIFWTTISYLAISATIGSCVVRDASGDVNDTMTPGPGPCEGLACGYGWNFTECSQQRSCRYGLINYYQTMSMVSAFAPLITAGIFGATLSSALACLVSAAKVFQCLCEDQLYPLIGFFGKGYGKNREPVRGYLLAYAIAVAFIIIAELNTIAPIISNFFLCSYALINFSCFHASITNSPGWRPSFRYYSKWAALFGAVISVVIMFLLTWWAALIAIGVVLFLLLYVIYKKPEVNWGSSVQAGSYNLALSYSVGLNEVEDHIKNYRPQCLVLTGPPNFRPALVDFVSTFTQNLSLMICGHVLIGPGKQRVPELRLIASGHTKWLNKRKIKAFYSDVIAEDLRSGVQILMQASGLGRMKPNILVVGFKRNWQSAHPATVEDYIGVLHDAFDFNYGVCVMRMREGLNVSEALQTHTTPEALIQEEQASTIFQSEQGKKTIDIYWLFDDGGLTLLIPYLLHRKKRWGKCKIRVFVGGQINRMDEERKAIISLLSKFRLGFHEVHVLPDINQKPQAEHTKRFEDMIAPFRLNDGFKDEATVTEMRRDCPWKISDEEINKNRIKSLRQVRLSEILLDYSRDAALIILTLPIGRKGKCPSSLYMAWLETLSQDLRPPVLLIRGNQENVLTFYCQ";

$regions = array(
		array('start' => 1, 'end' => 135, 'type' => 'intra'),
		array('start' => 136, 'end' => 156, 'type' => 'membrane'),
		array('start' => 157, 'end' => 158, 'type' => 'extra'),
		/*array('start' => 159, 'end' => 179, 'type' => 'membrane'),
		array('start' => 180, 'end' => 218, 'type' => 'intra'),
		array('start' => 219, 'end' => 239, 'type' => 'membrane'),
		array('start' => 240, 'end' => 261, 'type' => 'extra'),
		array('start' => 262, 'end' => 282, 'type' => 'membrane'),
		array('start' => 283, 'end' => 286, 'type' => 'intra'),
		array('start' => 287, 'end' => 307, 'type' => 'membrane'),
		array('start' => 308, 'end' => 339, 'type' => 'extra'),
		array('start' => 340, 'end' => 360, 'type' => 'membrane'),
		array('start' => 361, 'end' => 377, 'type' => 'intra'),
		array('start' => 378, 'end' => 398, 'type' => 'membrane'),
		array('start' => 399, 'end' => 452, 'type' => 'extra'),
		array('start' => 453, 'end' => 473, 'type' => 'membrane'),
		array('start' => 474, 'end' => 511, 'type' => 'intra'),
		array('start' => 512, 'end' => 532, 'type' => 'membrane'),
		array('start' => 533, 'end' => 534, 'type' => 'extra'),
		array('start' => 535, 'end' => 555, 'type' => 'membrane'),
		array('start' => 556, 'end' => 577, 'type' => 'intra'),
		array('start' => 578, 'end' => 598, 'type' => 'membrane'),
		array('start' => 599, 'end' => 660, 'type' => 'extra'),
		array('start' => 661, 'end' => 681, 'type' => 'membrane'),
		array('start' => 682, 'end' => 1001, 'type' => 'intra')*/
);

//Create peptide
$peptide = new Peptide(1, 1, 1001);

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
	}
	
	$peptide->addRegion($region);

}
$proteinCalc = new PeptideShape($peptide, $startCoord, $size);

$coords = $proteinCalc->getAACoordinates();


$params = $proteinCalc->getParams();

$dimension = $params['dimension'];
$membrane = $params['membrane'];

$minX = $dimension['minX'];
$maxX = $dimension['maxX'];
$minY = $dimension['minY'];
$maxY = $dimension['maxY'];

$height = $maxY - $minY;
$width = $maxX - $minX;



header("Content-type: image/svg+xml");
echo '<?xml version="1.0"?>';
echo '<?xml-stylesheet href="../a/css/protein.css" type="text/css" title="Default CSS" media="screen" charset="utf-8"?>';
echo '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink"
width="1000" height="800" xml:lang="fr"
preserveAspectRatio="xMinYMin meet"
viewBox="' . $minX . ' ' . $minY . ' ' . $width . ' ' . $height . '">';


echo $svgGraphics->drawMembrane($minX, $maxX, $membrane['minY'], $membrane['maxY']);

//drawing
foreach ($coords as $k => $v) {
	$x = $v["x"];
	$y = $v["y"];
	echo $svgGraphics->drawAminoAcid($x, $y, $size, $elements[$k], $k+1);
}

echo '</svg>';
?>