<?php

require_once(xContext::$basepath.'/lib/protview/protview/graph/SVGGraphics.php');
require_once(xContext::$basepath.'/lib/protview/protview/bio/Protein.php');
require_once(xContext::$basepath.'/lib/protview/protview/calc/ProteinCalc.php');

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

$svgGraphics = new SVGGraphics();


echo $svgGraphics->drawMembrane($membraneX, $membraneY, $membraneWidth, $membraneHeight);


/*Create protein test*/
$sequence = "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";

$domains = array(
			array('start' => 1, 'end' => 24, 'type' => 'extra'),
			array('start' => 25, 'end' => 46, 'type' => 'trans'),
			array('start' => 47, 'end' => 60, 'type' => 'intra'),
			array('start' => 61, 'end' => 80, 'type' => 'trans'),
			array('start' => 81, 'end' => 120, 'type' => 'extra')
		);

//Create protein
$protein = new Protein("Random protein", "Homo sapiens");
$protein->setNote("The following is a valid extended BIOML file");

//Create subunit
$subunit = new Subunit(1);
$subunit->setName("alpha-1 isoform a");

//Create peptide
$peptide = new Peptide(1, 1, 110);

//Initialize amino acid counter (id)
$count = 1;
//Reade sequence and create amino acid class for each value
//increases id by one for each amino acid
//adds amino acids to a domain

$elements = str_split($sequence);

for ($d = 0; $d < count($domains); $d++) {
	$dom = $domains[$d];
	
	$start = $dom['start'];
	$end = $dom['end'];
	$type = $dom['type'];
	
	$domain = new Domain($d+1, $start, $end, $type);
	
	for ($s = $start; $s <= $end; $s++) {
		$domain->addAminoAcid(new AminoAcid($s, $elements[$s]));
	}
	$peptide->addDomain($domain);

}


$subunit->addPeptide($peptide);
$protein->addSubunit($subunit);

$proteinCalc = new ProteinCalc($protein, $startCoord, $size);

$coords = $proteinCalc->getCoordinates();



//drawing
foreach ($coords as $k => $v) {
	$x = $v["x"] + 80;
	$y = $v["y"] + 358;
	echo $svgGraphics->drawAminoAcid($x, $y, $size, $elements[$k], $k+1);
}
echo '</svg>';
?>