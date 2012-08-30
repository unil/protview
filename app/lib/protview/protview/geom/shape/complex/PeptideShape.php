<?php
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/MembranePattern.php');
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/StandardLoop.php');
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/ExtendedLoop.php');

class PeptideShape {

	private $peptide;
	private $startCoord;
	private $aaSize;

	private $aaCoords = array();
	private $membraneCoords = array();

	public function __construct($peptide, $startCoord, $aaSize) {
		$this->peptide = $peptide;
		$this->startCoord = $startCoord;
		$this->aaSize = $aaSize;
		$this->calculateCoordinates();
	}

	private function calculateCoordinates() {
		$coords = array();
		$pos = 1;

		$countAminoAcids = $this->peptide->countBiggestMembrane();
		foreach ($this->peptide->getRegions() as $region) {
			$type = $region->getType();

			if ($type == 'intra')
				$pos = -1;
			else if ($type == 'extra')
				$pos = 1;
			if ($type == 'membrane') {
				$coords = array_merge($coords, $this->getMembranePart($region, $countAminoAcids, $pos));
			}
			else {
				$coord = $this->getExternalPart($region, $pos);
				$coords = array_merge($coords, $coord);

			}
		}

		$this->AAcoords = $coords;
	}

	/**
	 * Calculates coordinates of external part of the membraine
	 * @param unknown_type $region
	 * @param unknown_type $pos
	 */
	private function getExternalPart($region, $pos) {
		$coords = array();

		$aminoAcids = $region->getAminoAcids();

		$length = count($aminoAcids);

		$params = array(
				"basicHeight" => array('min' => 2, 'max' => 12),
				"middleLength" => array('even' => 4, 'odd' => 5),
				"extendHeight" => 5
		);


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




		if ($length <= (2*$params['basicHeight']['max'] + $middleLoopLength)) {
			$middle = $middleLoopLength + 6;
			$height = ($length - $middle)/2;

			$standardLoop = new StandardLoop($this->aaSize, $this->startCoord);
			$standardLoop->setSideLength($height);
			$standardLoop->setMiddleLength($middle);
			$standardLoop->setRotation(array('sens' => $pos));
			$coords = $standardLoop->getCoord();
			$this->startCoord = $standardLoop->getLastCoord();
		}
		else {
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
			
			if ($nbMiddlePart <= 1) {
				$middleLoopLength += + 6;
				$basicLength = ($length - $middleLoopLength - $extendLength);
				
			}


			$extendedLoop = new ExtendedLoop($this->aaSize, $this->startCoord);
			$extendedLoop->setRotation(array('sens' => $pos));
			$extendedLoop->setBasicLoopSideLength($basicLength/$nbBasicHeight);
			$extendedLoop->setExtendLoopSideLength($params['extendHeight']);
			$extendedLoop->setExtendLoopSideMiddleLength($middleLoopLength);
			$extendedLoop->setNbExtendLoop($nbMiddlePart);
			$coords = $extendedLoop->getCoord();
			$this->startCoord = $extendedLoop->getLastCoord();
		}


		return $coords;
	}

	private function getMembranePart($region, $countAminoAcids, $pos) {
		$coords = array ();

		$aminoAcids = $region->getAminoAcids();

		$length = count($aminoAcids);

		//Rotation angle
		$angle = -165;

		if ($pos == 1) {
			$angle = 345;
		}

		//distributes all elements in steady way to all lines
		$maxLines = 6; //number * amino acid size

		$membranePattern = new MembranePattern($this->aaSize, $this->startCoord);
		$membranePattern->setLength($length);
		$membranePattern->setMaxLineLength($maxLines);
		$membranePattern->setRotation(array('sens' => $pos, 'angle' => $angle));

		$coords = $membranePattern->getCoord();
		$this->startCoord = $membranePattern->getLastCoord();
		$this->membraneCoords = $membranePattern->getMembraneCoords();

		return $coords;
	}

	public function getAACoordinates() {
		return $this->AAcoords;
	}
	
	public function getParams() {
		$coords = $this->AAcoords;
		

		
		$dimension = array(
				"minX" => 0,
				"maxX" => 0,
				"minY" => 0,
				"maxY" => 0
		);

		foreach ($coords as $coord) {
			$x = $coord['x'];
			$y = $coord['y'];
			//calculates minY and maxY
			if ($y < $dimension['minY'])
				$dimension['minY'] = $y;
				
			if ($y > $dimension['maxY'])
				$dimension['maxY'] = $y;
				
			if ($x < $dimension['minX'])
				$dimension['minX'] = $x;
		
			if ($x > $dimension['maxX'])
				$dimension['maxX'] = $x;		
		}
		
		$dimension['minY'] -= $this->aaSize/2;
		$dimension['maxY'] += $this->aaSize/2;
		$dimension['minX'] -= $this->aaSize/2;
		$dimension['maxX'] += $this->aaSize/2;
		
		$this->membraneCoords['minY'] -= $this->aaSize;
		
		$params = array(
				"dimension" => $dimension,
				"membrane" => $this->membraneCoords
		);
		
		return $params;
	}
}

?>