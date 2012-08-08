<?php
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/Shape.php');

abstract class BasicShape extends Shape {
	private $nbPoints;

	public function __construct($offset, $startCoord = null) {
		parent::__construct($offset, $startCoord);
	}

	public function getNbPoints() {
		if ($this->nbPoints <= 0)
			throw new Exception("Number of points needs to be greather than 0 but is '{$this->nbPoints}'.");
		return $this->nbPoints;
	}

	public function setNbPoints($nbPoints) {
		$this->nbPoints = $nbPoints;
	}
	
	
	
}


?>