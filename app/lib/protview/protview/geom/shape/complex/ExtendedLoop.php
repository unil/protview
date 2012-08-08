<?php

require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/Circle.php');
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/Line.php');

class ExtendedLoop extends ComplexShape {

	private $extendLoopSideLength;
	private $extendLoopSideMiddleLength;
	private $nbExtendLoop = 1;
	private $basicLoopSideLength;

	public function __construct($offset, $startCoord = null) {
		parent::__construct($offset, $startCoord);
	}

	public function setExtendLoopSideLength($extendLoopSideLength)
	{
		$this->extendLoopSideLength = $extendLoopSideLength;
	}
	
	public function setExtendLoopSideMiddleLength($extendLoopSideMiddleLength)
	{
		$this->extendLoopSideMiddleLength = $extendLoopSideMiddleLength;
	}
	
	public function setNbExtendLoop($nbExtendLoop)
	{
		$this->nbExtendLoop = $nbExtendLoop;
	}
	
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
		
		//left basic side
		$lastCoord['y'] -= $offset * $rotation['sens'];
		$line = new Line($offset, $lastCoord);
		$line->setRotation(array('sens' => $rotation['sens']));
		$line->setNbPoints($this->basicLoopSideLength);
		$coord = $line->getCoord();
		$coords = array_merge($coords, $coord);
		$lastCoord = $line->getLastCoord();
		
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
		
		//right basic side
		$lastCoord['y'] += $offset * $rotation['sens'];
		$line = new Line($offset, $lastCoord);
		$line->setRotation(array('sens' => $rotation['sens'] * -1));
		$line->setNbPoints($this->basicLoopSideLength);
		$coord = $line->getCoord();
		$coords = array_merge($coords, $coord);
		$lastCoord = $line->getLastCoord();
		
		parent::setLastCoord($lastCoord);
	
		return $coords;
	}
}

?>