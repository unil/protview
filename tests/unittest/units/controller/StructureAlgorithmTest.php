<?php
/**
 * Tests ProteinController class
 * Test are made at xModel level.
 * @package unittests
 */
class StructureAlgorithmTest extends protviewPHPUnit_Framework_TestCase {


	function test_Algorithm() {
		$r = array();
		$sequence = "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		

		$items = array (
				'peptide_id' => 1,
				'sequence' => $sequence,
				'terminusN' => 'intra',
				'terminusC' => 'intra',
				'membraneRegions' => array(
						array('id' => 2, 'start' => 18, 'end' => 36),
						array('id' => 0, 'start' => 58, 'end' => 105)
				)
		);


		$peptide_id = $items['peptide_id'];
		$terminusN = $items['terminusN'];
		$terminusC = $items['terminusC'];

		$sequence = strtoupper(trim($items['sequence']));
		$aaArray = str_split($sequence);
		$membraneRegions = $items['membraneRegions'];

		$aaCount = count($aaArray);
		$start = 1;
		$end = 1;

		$pos = 1;
		$type = $terminusN;

		//in order to return items
		$items = array();

		$regions = array();
		for ($i = 0; $i < count($membraneRegions); $i++) {
			$currentRegion = $membraneRegions[$i];
			$region = array();
			/*evaluate number of aa between two membrane regions in order to
			 *determine the start/end value of the region betweeen
			*/
			$end = $currentRegion['start'] - 1;

			if ($end - $start > 0) {
				$region['id'] = 0;
				$region['start'] = $start;
				$region['end'] = $end;
				$region['type'] = $type;
				$region['pos'] = $pos;
				$regions[] = $region;
				$region = array();
				$pos++;
			}

			//membrane region
			$region['id'] = $currentRegion['id'];
			$region['start'] = $currentRegion['start'];
			$region['end'] = $currentRegion['end'];
			$region['type'] = 'membrane';
			$region['pos'] = $pos;
			$regions[] = $region;
			$pos++;

			if ($type == 'intra')
				$type = 'extra';
			else
				$type = 'intra';

			$start = $currentRegion['end'] + 1;
		}
		
		if ($aaCount - $start <= 0)
			throw new xException('Sequence is too short for indicate membrane regions.', 400);
		
		//distribute the last aa in a new region
		$region['start'] = $start;
		$region['end'] = $aaCount;
		$region['type'] = $type;
		$region['pos'] = $pos;
		$regions[] = $region;
		$region = array();

		
		if ($type != $terminusC)
			throw new xException('No N/C-Terminus are not correct for regions specified', 400);

		$r['regions'] = $regions;
		$r['amino-acids'] = array();
		
		echo "aaCount: $aaCount";
		
		//insert into database
		foreach($regions as $region) {
			print_r($region);
			$retR = xController::load(
					'regions', array(
							'items' => array (
									'id' => 0, //new region id=0
									'peptide_id' => $peptide_id,
									'label' => null,
									'type' => $region['type'],
									'pos' => $region['pos']
							)
					))->put();
			$r['regions'][] = $retR;
			$start = $region['start'];
			$end = $region['end'];

			//Read sequence and take amino acid each value
			//increases it's pos
			//adds amino acids to the correction region
			for ($s = $start-1; $s < $end; $s++) {
				$retA = xController::load(
						'amino-acids', array(
								'items' => array (
										'id' => 0, //new aa id=0
										'region_id' => $retR['xinsertid'],
										'type' => $aaArray[$s],
										'pos' => $s
								)
						))->put();
			}
			$r['amino-acids'][] = $retA;
		}
		
		print_r($r);
	}
}
?>