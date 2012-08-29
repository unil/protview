<?php
/**
 * Tests ProteinController class
 * Test are made at xModel level.
 * @package unittests
 */
class PeptideControllerTest extends protviewPHPUnit_Framework_TestCase {

	function test_extionLoopAlgo() {
		$params = array(
				"basicHeight" => array('min' => 0, 'max' => 9),
				"middleLength" => array('even' => 4, 'odd' => 5),
				"extendHeight" => 4
		);

		$length = 14;

		$middleLooopLength = 0;
		$basicHeight = 0;
		$extendHeight = 0;

		//event length number
		if ($length % 2 == 0)
			$middleLoopLength = $params['middleLength']['even'];
		else
			$middleLoopLength = $params['middleLength']['odd'];
			

		//min space between domain, needs to be implemented and should not be hardcoded
		//$middle = ceil($params['minDomainSpace']/$this->aaSize);

		/* nb cercle - nb extendHeigh
		 * 1-2
		* 3-4
		* 5-6
		* 7-8
		*/
		
		$nbBasic = 2;
		$nbExtendHeight = 1;
		$nbMiddlePart = 0;
		
		$res = 0;
		
		while ($length > $res) {
			$nbExtendHeight++;
			$nbMiddlePart++;
				
			$res = $nbBasic * $params['basicHeight']['max']
			+ $nbExtendHeight + $params['extendHeight']
			+ $nbMiddlePart + $middleLoopLength;
		}
		
		$middleLength = $nbMiddlePart * $middleLoopLength;
		$extendLength = $nbExtendHeight * $params['extendHeight'];
		$basicLength = $length - $middleLength - $extendLength;
		
		
		echo "lenth : $length\n";
		echo "nbMiddlePart : $nbMiddlePart middleLoopLength: $middleLoopLength\n";
		echo "middleLength: $middleLength\n";
		echo "nbExtendHeigth : $nbExtendHeight extendHeight: {$params['extendHeight']}\n";
		echo "extendLength $extendLength\n";
		echo "basicLength : $basicLength";

		$this->assertTrue(true);


		/*if ($length <= (2*$params['basicHeight']['max'] + $middleLoopLength)) {
			$height = ($length - $middle)/2;
				
			$standardLoop = new StandardLoop($this->aaSize, $this->startCoord);
			$standardLoop->setSideLength($height);
			$standardLoop->setMiddleLength($middle);
			$standardLoop->setRotation(array('sens' => $pos));
			$coords = $standardLoop->getCoord();
			$this->startCoord = $standardLoop->getLastCoord();
		}
		else {

				
			$extendedLoop = new ExtendedLoop($this->aaSize, $this->startCoord);
			$extendedLoop->setRotation(array('sens' => $pos));
			$extendedLoop->setBasicLoopSideLength($basicLength/$nbBasic);
			$extendedLoop->setExtendLoopSideLength($extendLength/$extendHeight);
			$extendedLoop->setExtendLoopSideMiddleLength($middleLoopLength);
			$extendedLoop->setNbExtendLoop($nbExtendHeight);
			$coords = $extendedLoop->getCoord();
			$this->startCoord = $extendedLoop->getLastCoord();
		}*/
	}

}
?>