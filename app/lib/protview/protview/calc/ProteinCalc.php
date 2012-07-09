<?php

require_once('CoordinatesCalculator.php');

class ProteinCalc {
	
	private $protein;
	private $startCoord;
	private $aaSize;
	private $coordinatesCalculator;
	
	public function __construct($protein, $startCoord, $aaSize) {
		$this->protein = $protein;
		$this->startCoord = $startCoord;
		$this->aaSize = $aaSize;
		$this->coordinatesCalculator = new CoordinatesCalculator($aaSize, $this->startCoord);
	}
	
	/**
	 * Calculates coordinates of external part of the membraine
	 * @param unknown_type $domain
	 * @param unknown_type $pos
	 */
	private function getExtPart($domain, $pos) {
		$coords = array();
		
		$aminoAcids = $domain->getAminoAcids();
		
		$length = count($aminoAcids);
		
		$height = (int)($length/3);
		
		
		//left
		$this->coordinatesCalculator->setSequenceLength($height);
		$endCoord = $this->coordinatesCalculator->getEndCoord();
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine($pos);
		$coords = array_merge($coords, $coord);
			
		//middle
		$this->coordinatesCalculator->setSequenceLength($length - 2*$height);
		$endCoord = $this->coordinatesCalculator->getEndCoord();
			
		$endCoord['y'] -= $this->aaSize * $pos;
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateArc($pos);
		$coords = array_merge($coords, $coord);
		
		//right
		$this->coordinatesCalculator->setSequenceLength($height);
		$endCoord = $this->coordinatesCalculator->getEndCoord();
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine(-1 * $pos);
		$coords = array_merge($coords, $coord);
			
		return $coords;
	}
	
	private function getIntPart($domain, $pos) {
		$coords = array ();
		
		$aminoAcids = $domain->getAminoAcids();
		
		$length = count($aminoAcids);
		
		$angle = 165;
		
		if ($pos == -1) {
			$angle = 345;
		}
		
		//membrane
		$this->coordinatesCalculator->setSequenceLength(4);
		$endCoord = $this->coordinatesCalculator->getEndCoord();
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine(1, $angle);
		$coords = array_merge($coords, $coord);
		
		$endCoord['y'] -= $this->aaSize * $pos;
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine(1, $angle);
		$coords = array_merge($coords, $coord);
		
		$endCoord['x'] += $this->aaSize * $pos;
		$endCoord['y'] -= $this->aaSize * $pos;;
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine(1, $angle);
		$coords = array_merge($coords, $coord);
		
		$endCoord['x'] -= $this->aaSize * $pos;
		$endCoord['y'] -= $this->aaSize * $pos;
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine(1, $angle);
		$coords = array_merge($coords, $coord);
		
		$endCoord['x'] += $this->aaSize * $pos;
		$endCoord['y'] -= $this->aaSize * $pos;
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine(1, $angle);
		$coords = array_merge($coords, $coord);
		
		return $coords;
	}
	
	public function getCoordinates() {	
		$coords = array();
		
		foreach ($this->protein->getSubunits() as $subunit) {
			foreach ($subunit->getPeptides() as $peptide) {
				foreach ($peptide->getDomains() as $domain) {
					$type = $domain->getType();
					$pos = 1;
					if ($type == 'trans')
						$coords = array_merge($coords, $this->getIntPart($domain, -1));
					else {
						if ($type == 'intra') {
							$pos = -1;
						}
							
						$coords = array_merge($coords, $this->getExtPart($domain, $pos));
					}
				}
			}
		}
		
		return $coords;
	}
}

?>