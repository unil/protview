<?php
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/MembranePattern.php');
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/StandardLoop.php');
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/ExtendedLoop.php');

class TransmembraneProtein {
	
	private $params = array(
			"maxHeigh" => 1000, //max graphic height in px
			"maxWidth" => 1000, //max graphic width in px
			"minDmainSpace" => 20 //min space beetwen ext/int domain in px
			);
	private $protein;
	private $startCoord;
	private $aaSize;

	
	private $aaCoords = array();
	private $membraneCoords = array("startX" => 0, "startY" => 0, "height" => 0, "width" => 0);
	
	public function __construct($protein, $startCoord, $aaSize) {
		$this->protein = $protein;
		$this->startCoord = $startCoord;
		$this->aaSize = $aaSize;
		$this->calculateCoordinates();
	}
	
	private function calculateCoordinates() {
		$coords = array();
		$pos = 1;
		foreach ($this->protein->getSubunits() as $subunit) {
			foreach ($subunit->getPeptides() as $peptide) {
				
				$countAminoAcids = $peptide->countBiggestMembrane();			
				foreach ($peptide->getDomains() as $domain) {
					$type = $domain->getType();
						
					if ($type == 'intra')
						$pos = -1;
					else if ($type == 'extra')
						$pos = 1;
					if ($type == 'trans') {
						$coords = array_merge($coords, $this->getMembranePart($domain, $countAminoAcids, $pos));
					}
					else {
						$coord = $this->getExternalPart($domain, $pos);
						$coords = array_merge($coords, $coord);
						
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
		
		if ($height <= 10) {
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
			$extendedLoop->setBasicLoopSideLength(8);
			$extendedLoop->setExtendLoopSideLength(7);
			$extendedLoop->setExtendLoopSideMiddleLength(6);
			$extendedLoop->setNbExtendLoop(7);
			$coords = $extendedLoop->getCoord();
			$this->startCoord = $extendedLoop->getLastCoord();
		}
		
		return $coords;
	}
	
	private function getMembranePart($domain, $countAminoAcids, $pos) {
		$coords = array ();
		
		$aminoAcids = $domain->getAminoAcids();
		
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
	
	public function getMembraneCoordinates() {
		$this->membraneCoords['startX'] -= $this->aaSize/2;
		$this->membraneCoords['startY'] += $this->aaSize/2;
		
		
		return $this->membraneCoords;
	}
}

?>