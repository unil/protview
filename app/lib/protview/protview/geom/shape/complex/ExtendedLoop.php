<?php

require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/Circle.php');
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/Line.php');
/**
 * Calculates an extended loop
 *
 * @package protview\geom\shape\complex
 * @author Stefan Meier
 * @version 20120906
 *
 */
class ExtendedLoop extends ComplexShape {

	private $extendLoopSideLength;
	private $extendLoopSideMiddleLength;
	private $nbExtendLoop = 1;
	private $basicLoopSideLength;

	public function __construct($offset, $startCoord = null) {
		parent::__construct($offset, $startCoord);
	}

	/**
	 * Sets the extension side length
	 * 
	 * @param int $extendLoopSideLength
	 */
	public function setExtendLoopSideLength($extendLoopSideLength)
	{
		$this->extendLoopSideLength = $extendLoopSideLength;
	}

	/**
	 * Sets the extend loop cercle length
	 * @param int $extendLoopSideMiddleLength
	 */
	public function setExtendLoopSideMiddleLength($extendLoopSideMiddleLength)
	{
		$this->extendLoopSideMiddleLength = $extendLoopSideMiddleLength;
	}

	/**
	 * Sets number of extension loops
	 * @param int $nbExtendLoop
	 */
	public function setNbExtendLoop($nbExtendLoop)
	{
		$this->nbExtendLoop = $nbExtendLoop;
	}

	/**
	 * Sets basic height
	 * @param int $basicLoopSideLength
	 */
	public function setBasicLoopSideLength($basicLoopSideLength)
	{
		$this->basicLoopSideLength = $basicLoopSideLength;
	}

	public function getCoord() {
		$coords = array();
		$rotation = parent::getRotation();
		$offset = parent::getOffset();
		$startCoord = parent::getStartCoord();

		$lastCoord = $startCoord;

		if ($this->basicLoopSideLength > 0) {
			//left basic side
			$lastCoord['y'] -= $offset * $rotation['sens'];
			$line = new Line($offset, $lastCoord);
			$line->setRotation(array('sens' => $rotation['sens']));
			$line->setNbPoints($this->basicLoopSideLength);
			$coord = $line->getCoord();
			$coords = array_merge($coords, $coord);
			$lastCoord = $line->getLastCoord();
		}

		/*EXTENDED LOOP BEGIN*/
		$sens = $rotation['sens'];
		for ($nb = 0; $nb < $this->nbExtendLoop; $nb++) {
				
			//left side
			$lastCoord['y'] -= $offset * $sens;
			$line = new Line($offset, $lastCoord);
			$line->setRotation(array('sens' => $sens));
			$line->setNbPoints($this->extendLoopSideLength);
			$coord = $line->getCoord();
			$coords = array_merge($coords, $coord);
			$lastCoord = $line->getLastCoord();
				
			//middle
			$lastCoord['y'] -= $offset * $sens;
			$circle = new Circle($offset, $lastCoord);
			$circle->setNbPoints($this->extendLoopSideMiddleLength);
			$circle->setRotation(array('sens' => $sens));
			$coord = $circle->getCoord();
			$coords = array_merge($coords, $coord);
			$lastCoord = $circle->getLastCoord();

			if ($nb % 2 == 0)
				$sens = $rotation['sens'] * -1;
			else
				$sens = $rotation['sens'];
		}
		//right side
		$lastCoord['y'] -= $offset * $sens;
		$line = new Line($offset, $lastCoord);
		$line->setRotation(array('sens' => $sens));
		$line->setNbPoints($this->extendLoopSideLength);
		$coord = $line->getCoord();
		$coords = array_merge($coords, $coord);
		$lastCoord = $line->getLastCoord();
		/*EXTENDED LOOP END*/

		if ($this->basicLoopSideLength > 0) {
			//right basic side
			$lastCoord['y'] += $offset * $rotation['sens'];
			$line = new Line($offset, $lastCoord);
			$line->setRotation(array('sens' => $rotation['sens'] * -1));
			$line->setNbPoints($this->basicLoopSideLength);
			$coord = $line->getCoord();
			$coords = array_merge($coords, $coord);
			$lastCoord = $line->getLastCoord();
		}

		parent::setLastCoord($lastCoord);

		return $coords;
	}
}

?>