<?php
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/BasicShape.php');

class Circle extends BasicShape {
	public function __construct($offset, $startCoord = null) {
		parent::__construct($offset, $startCoord);
		parent::setRotation(array('angle' => 180));
	}
	
	/**
	 * Calculates the coordinates of each point on a line
	 *
	 * A rotation angle can be specified for the line
	 * Points can be scatter points and the distance between each point
	 * is equal to the scatter's diameter
	 *
	 * @param int $rotationSense (1 = bottom->up; -1 = top->down)
	 * @param int $angle (rotation angle, default 90° = vertical)
	 * @return array $coord (coordinates of each point)
	 */
	public function getCoord() {
		$coord = array();
		
		$nbPoints = parent::getNbPoints();
		
		/* calculates the cercle's radius
		 *
		* r = perimeter / pi
		*
		* perimeter = scatterSize * sequenceLength
		*/
		$r = parent::getOffset() * $nbPoints / M_PI;
		
		$rotation = parent::getRotation();
		$degree = $rotation['angle'];
		/*
		 * calculates spaces between each point
		*
		* degrees / number of elements
		*/
		$offset = $degree/($nbPoints-1);
		

		$startCoord = parent::getStartCoord();
		$count = 1;
		
		for ($nb = 0; $nb < $nbPoints; $nb++) {
			$nx = Formula::getX($r, $rotation['sens'] * $degree);
			$ny = Formula::getY($r, $rotation['sens'] * $degree);
			
			$x = $startCoord['x'] + $nx + $r;
			$y = $startCoord['y'] - $ny;
				
			$point = array("x" => $x, "y" => $y);
			
			$coord[] = $point;
			$degree -= $offset;
		}
	
		parent::setLastCoord(end($coord));
		return $coord;
	}
}

?>