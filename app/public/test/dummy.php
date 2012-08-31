<?php
require_once(dirname(__file__).'/../../lib/protview/xfm/Bootstrap.php');

$b = new Bootstrap();

$sequence = "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";

$regions = array(
		array('start' => 18, 'end' => 36, 'type' => 'membrane'),
		array('start' => 58, 'end' => 78, 'type' => 'membrane'),
		array('start' => 121, 'end' => 150, 'type' => 'membrane'),
		array('start' => 301, 'end' => 318, 'type' => 'membrane'),
		array('start' => 341, 'end' => 360, 'type' => 'membrane'),
		array('start' => 381, 'end' => 410, 'type' => 'membrane'),
		array('start' => 432, 'end' => 450, 'type' => 'membrane'),
);
$ret = xController::load(
		'peptides', array(
				'items' => array (
						'id' => 1,
						'sequence' => $sequence,
						'terminusN' => 'intra',
						'terminusC' => 'extra',
						'regions' => $regions
				)
		))->put();

print_r($ret);

$ret = xController::load(
		'representations', array(
				'items' => array (
						'peptide_id' => 1
				)
		))->put();
print_r($ret);
?>