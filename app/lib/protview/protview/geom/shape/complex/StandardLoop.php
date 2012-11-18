<?php

require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/ComplexShape.php');
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/Line.php');
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/Circle.php');
/**
 * Calculates position of each point in a standard loop shape
 *
 * @package protview\geom\shape\complex
 * @author Stefan Meier
 * @version 20120906
 *
 */
class StandardLoop extends ComplexShape {

	private $sideLength;
	private $middleLength;

	public function __construct($offset, $startCoord = null) {
		parent::__construct($offset, $startCoord);
	}

	/**
	 * Sets side length
	 * @param int $sideLength
	 */
	public function setSideLength($sideLength)
	{
		$this->sideLength = $sideLength;
	}

	/**
	 * Sets middle lenth
	 * @param int $middleLength
	 */
	public function setMiddleLength($middleLength)
	{
		$this->middleLength = $middleLength;
	}


	/**
	 * @see Shape::getCoord()
	 */
	public function getCoord() {
		$coords = array();
		$line = null;
		$circle = null;
		$rotation = parent::getRotation();
		$lastCoord = parent::getStartCoord();;

		//left side
		if ($this->sideLength > 0) {
			$lastCoord['y'] -= parent::getOffset() * $rotation['sens'];
			$line = new Line(parent::getOffset(), $lastCoord);
			$line->setRotation(array('sens' => $rotation['sens']));
			$line->setNbPoints($this->sideLength);
			$coord = $line->getCoord();
			$coords = array_merge($coords, $coord);
			$lastCoord = $line->getLastCoord();
		}
			
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
		if ($this->sideLength > 0) {
			$lastCoord['y'] += parent::getOffset() * $rotation['sens'];
			$line = new Line(parent::getOffset(), $lastCoord);
			$line->setRotation(array('sens' => $rotation['sens'] * -1));
			$line->setNbPoints($this->sideLength);
			$coord = $line->getCoord();
			$coords = array_merge($coords, $coord);
			$lastCoord = $line->getLastCoord();
		}


		parent::setLastCoord($lastCoord);

		return $coords;
	}
}

?>