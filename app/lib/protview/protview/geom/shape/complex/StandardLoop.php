<?php

require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/ComplexShape.php');
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/Line.php');
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/Circle.php');

class StandardLoop extends ComplexShape {

	private $sideLength;
	private $middleLength;

	public function __construct($offset, $startCoord = null) {
		parent::__construct($offset, $startCoord);
	}

	public function setSideLength($sideLength)
	{
		$this->sideLength = $sideLength;
	}

	public function setMiddleLength($middleLength)
	{
		$this->middleLength = $middleLength;
	}


	public function getCoord() {
		$coords = array();
		$line = null;
		$circle = null;
		$rotation = parent::getRotation();
		$lastCoord = parent::getStartCoord();;

		//left side
		$lastCoord['y'] -= parent::getOffset() * $rotation['sens'];
		$line = new Line(parent::getOffset(), $lastCoord);
		$line->setRotation(array('sens' => $rotation['sens']));
		$line->setNbPoints($this->sideLength);
		$coord = $line->getCoord();
		$coords = array_merge($coords, $coord);
		$lastCoord = $line->getLastCoord();
			
		//middle
		$lastCoord['y'] -= parent::getOffset() * $rotation['sens'];
		$circle = new Circle(parent::getOffset(), $lastCoord);
		$circle->setNbPoints($this->middleLength);
		$circle->setRotation(array('sens' => $rotation['sens']));
		$coord = $circle->getCoord();
		$coords = array_merge($coords, $coord);
		$lastCoord = $circle->getLastCoord();
			
		//$lastCoord = $startCoord = parent::getStartCoord();

		//right side
		$lastCoord['y'] += parent::getOffset() * $rotation['sens'];
		$line = new Line(parent::getOffset(), $lastCoord);
		$line->setRotation(array('sens' => $rotation['sens'] * -1));
		$line->setNbPoints($this->sideLength);
		$coord = $line->getCoord();
		$coords = array_merge($coords, $coord);
		$lastCoord = $line->getLastCoord();


		parent::setLastCoord($lastCoord);

		return $coords;
	}
}

?>