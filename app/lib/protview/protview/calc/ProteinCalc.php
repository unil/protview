<?php

require_once('CoordinatesCalculator.php');

class ProteinCalc {
	
	private $params = array(
			"maxHeigh" => 1000, //max graphic height in px
			"maxWidth" => 1000, //max graphic width in px
			"minDmainSpace" => 20 //min space beetwen ext/int domain in px
			);
	private $protein;
	private $startCoord;
	private $aaSize;
	private $coordinatesCalculator;
	
	private $aaCoords = array();
	private $membraneCoords = array("startX" => 0, "startY" => 0, "height" => 0, "width" => 0);
	
	public function __construct($protein, $startCoord, $aaSize) {
		$this->protein = $protein;
		$this->startCoord = $startCoord;
		$this->aaSize = $aaSize;
		$this->coordinatesCalculator = new CoordinatesCalculator($aaSize, $this->startCoord);
		$this->calculateCoordinates();
	}
	
	private function calculateCoordinates() {
		$coords = array();
		$pos = 1;
		foreach ($this->protein->getSubunits() as $subunit) {
			foreach ($subunit->getPeptides() as $peptide) {
				
				$countAminoAcids = $peptide->countAminoAcids();				
				foreach ($peptide->getDomains() as $domain) {
					$type = $domain->getType();
						
					if ($type == 'intra')
						$pos = -1;
					else if ($type == 'extra')
						$pos = 1;
					if ($type == 'trans')
						$coords = array_merge($coords, $this->getMembranePart($domain, $countAminoAcids, $pos));
					else {
						$coords = array_merge($coords, $this->getExternalPart($domain, $pos));
					}
				}
			}
		}
	
		$this->AAcoords = $coords;
	}
	
	/**
	 * Calculates coordinates of external part of the membraine
	 * @param unknown_type $domain
	 * @param unknown_type $pos
	 */
	private function getExternalPart($domain, $pos) {
		$coords = array();
		
		$aminoAcids = $domain->getAminoAcids();
		
		$length = count($aminoAcids);
		
		$even = false;
		
		$params = array(
				"maxHeigh" => 1000, //max graphic height in px
				"maxWidth" => 1000, //max graphic width in px
				"minDomainSpace" => 150 //min space beetwen ext/int domain in px
		);
		

		$middle = 0;
		
		if ($length % 2 == 0)
			$even = true;
		
		if ($length <= 20) {
			if ($even)
				$middle = 8;
			else 
				$middle = 7;
		}
		else {
			if ($even)
				$middle = 4;
			else
				$middle = 3;
			
		}
		
		//min space between domain, needs to be implemented and should not be hardcoded
		$middle = ceil($params['minDomainSpace']/$this->aaSize);
		
		$height = ($length - $middle)/2;		
		
		//left
		
		$this->coordinatesCalculator->setSequenceLength($height);
		$endCoord = $this->coordinatesCalculator->getEndCoord();	
		$endCoord['y'] -= $this->aaSize * $pos;
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine($pos);
		$coords = array_merge($coords, $coord);

		//middle
		$this->coordinatesCalculator->setSequenceLength($middle);
		$endCoord = $this->coordinatesCalculator->getEndCoord();			
		$endCoord['y'] -= $this->aaSize * $pos;	
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateCercle($pos);
		$coords = array_merge($coords, $coord);
	
		//right
		$this->coordinatesCalculator->setSequenceLength($height);
		$endCoord = $this->coordinatesCalculator->getEndCoord();	
		$endCoord['y'] += $this->aaSize * $pos;
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine(-1 * $pos);
		$coords = array_merge($coords, $coord);
		return $coords;
	}
	
	private function getMembranePart($domain, $countAminoAcids, $pos) {
		$coords = array ();
		
		$aminoAcids = $domain->getAminoAcids();
		
		$length = count($aminoAcids);

		$maxLengthPerIteration = 5;
		
		$angle = 165;
		
		if ($pos == 1) {
			$angle = 345;
		}
		
		$endCoord = $this->coordinatesCalculator->getEndCoord();
		//initial x,y coordiante
		$endCoord['y'] += $this->aaSize * $pos;
		$startX = $endCoord['x'];
		$startY = $endCoord['y'];
		
		$this->coordinatesCalculator->setStartCoord($endCoord);
		
		
		for ($i = 0; $i < $length; $i += $maxLengthPerIteration) {
			$currentLength = $maxLengthPerIteration;
			
			/*if ($i += $maxLengthPerIteration >$length) {
				$currentLength = $length - $i;
			}*/
			
			$this->coordinatesCalculator->setSequenceLength($currentLength);

			$coord = $this->coordinatesCalculator->calculateLine(1, $angle);
			$coords = array_merge($coords, $coord);

			$endCoord = $this->coordinatesCalculator->getEndCoord();
			//always start at inital x coordinate
			$endCoord['x'] = $startX;
			$this->coordinatesCalculator->setStartCoord($endCoord);
			
		}
		
		$endCoord = $this->coordinatesCalculator->getEndCoord();
		
		if ($startX < $this->membraneCoords['startX'])
			$this->membraneCoords['startX'] = $startX;
		
		if ($startY < $this->membraneCoords['startY'])
			$this->membraneCoords['startY'] = $startY;
		
		if ($endCoord['x'] - $startX > $this->membraneCoords['width'])
			$this->membraneCoords['width'] = $endCoord['x'] - $startX;
		
		if ($endCoord['y'] - $startY > $this->membraneCoords['height'])
			$this->membraneCoords['height'] = $endCoord['y'] - $startY;
		
		return $coords;
	}
	
	public function getAACoordinates() {
		return $this->AAcoords;
	}
	
	public function getMembraneCoordinates() {
		$this->membraneCoords['startX'] -= $this->aaSize/2;
		
		
		return $this->membraneCoords;
	}
}

?>