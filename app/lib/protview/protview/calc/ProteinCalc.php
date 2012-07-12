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
	private function getExternalPart($domain, $pos) {
		$coords = array();
		
		$aminoAcids = $domain->getAminoAcids();
		
		$length = count($aminoAcids);
		
		$height = (int)($length/3);
		$height = 3;
		$even = false;
		
		
		$middleMax = 7;
		$middle = 0;
		
		if ($length % 2 == 0)
			$even;
		
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
		
		
		$height = ($length - $middle)/2;
		
		
		//left
		$this->coordinatesCalculator->setSequenceLength($height);
		$endCoord = $this->coordinatesCalculator->getEndCoord();
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine($pos);
		$coords = array_merge($coords, $coord);


			//middle
			$this->coordinatesCalculator->setSequenceLength($middle);
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
	
	private function getMembranePart($domain, $pos) {
		$coords = array ();
		
		$aminoAcids = $domain->getAminoAcids();
		
		$length = count($aminoAcids);
		$maxLengthPerIteration = 4;
		
		$angle = 165;
		
		if ($pos == 1) {
			$angle = 345;
		}
		
		$endCoord = $this->coordinatesCalculator->getEndCoord();
		//initial x coordiante
		$x = $endCoord['x'];
		
		
		for ($i = 0; $i < $length; $i += $maxLengthPerIteration) {
			$this->coordinatesCalculator->setSequenceLength($maxLengthPerIteration);
			$endCoord = $this->coordinatesCalculator->getEndCoord();
			//always start at inital x coordinate
			$endCoord['x'] = $x;
			$this->coordinatesCalculator->setStartCoord($endCoord);
			$coord = $this->coordinatesCalculator->calculateLine(1, $angle);
			$coords = array_merge($coords, $coord);
			
		}
		
		//membrane

		/*
		$endCoord['y'] -= $this->aaSize * $pos;
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine(1, $angle);
		$coords = array_merge($coords, $coord);
		
		//$endCoord['x'] += $this->aaSize * $pos;
		$endCoord['y'] -= $this->aaSize * $pos;;
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine(1, $angle);
		$coords = array_merge($coords, $coord);
		
		//$endCoord['x'] -= $this->aaSize * $pos;
		$endCoord['y'] -= $this->aaSize * $pos;
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine(1, $angle);
		$coords = array_merge($coords, $coord);
		
		//$endCoord['x'] += $this->aaSize * $pos;
		$endCoord['y'] -= $this->aaSize * $pos;
		$this->coordinatesCalculator->setStartCoord($endCoord);
		$coord = $this->coordinatesCalculator->calculateLine(1, $angle);
		$coords = array_merge($coords, $coord);*/
		
		return $coords;
	}
	
	public function getCoordinates() {	
		$coords = array();
		$pos = 1;
		foreach ($this->protein->getSubunits() as $subunit) {
			foreach ($subunit->getPeptides() as $peptide) {
				foreach ($peptide->getDomains() as $domain) {
					$type = $domain->getType();
					
					if ($type == 'intra')
						$pos = -1;
					else if ($type == 'extra')
						$pos = 1;
					
					xContext::$log->log("Type: {$type} Position: {$pos}", 'protein');
					
					if ($type == 'trans')
						$coords = array_merge($coords, $this->getMembranePart($domain, $pos));
					else {
						$coords = array_merge($coords, $this->getExternalPart($domain, $pos));
					}
				}
			}
		}
		
		return $coords;
	}
}

?>