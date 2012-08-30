<?php
/**
 * Tests ProteinController class
 * Test are made at xModel level.
 * @package unittests
 */
class ExtendLoopTest extends protviewPHPUnit_Framework_TestCase {

	function test_extionLoopAlgo() {
		$params = array(
				"basicHeight" => array('min' => 2, 'max' => 12),
				"middleLength" => array('even' => 4, 'odd' => 5),
				"extendHeight" => 5
		);

		$length = 35;

		//min space between domain, needs to be implemented and should not be hardcoded
		//$middle = ceil($params['minDomainSpace']/$this->aaSize);

		/* nb cercle - nb extendHeigh
		 * 1-2
		* 3-4
		* 5-6
		* 7-8
		*/

		$nbBasicHeight = 2;
		$nbExtendHeight = 0;
		$nbMiddlePart = -1;
		$middleLoopLength = 0;
		$middleLength = 0;
		$extendLength = 0;

		$basicLength = 0;

		$found = false;

		$res = 0;

		while (!$found) {
			$nbMiddlePart += 2;
			$nbExtendHeight = $nbMiddlePart + 1;

			$extendLength = $nbExtendHeight * $params['extendHeight'];

			if (($length - $extendLength) % 2 == 0)
				$middleLoopLength = $params['middleLength']['even'];
			else
				$middleLoopLength = $params['middleLength']['odd'];
				
			$middleLength = $nbMiddlePart * $middleLoopLength;

			$basicLength = $length - $middleLength - $extendLength;
				
			if ($basicLength /$nbBasicHeight >= $params['basicHeight']['min'] &&
					$basicLength / $nbBasicHeight <= $params['basicHeight']['max']) {
				$found = true;
			}
				
		}

		echo "length : $length\n";
		echo "nbMiddlePart : $nbMiddlePart middleLoopLength: $middleLoopLength\n";
		echo "middleLength: $middleLength\n";
		echo "nbExtendHeigth : $nbExtendHeight extendHeight: {$params['extendHeight']}\n";
		echo "extendLength $extendLength\n";
		echo "basicLength : $basicLength";

		$this->assertTrue(true);
	}

}
?>