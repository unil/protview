<?php
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/BasicShape.php');

class Line extends BasicShape {
	public function __construct($offset, $startCoord = null) {
		parent::__construct($offset, $startCoord);
		parent::setRotation(array('angle' => 90));
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
	
		$startCoord = parent::getStartCoord();

		$x = $startCoord['x'];
		$y = $startCoord['y'];
		$rotation = parent::getRotation();

		$r = parent::getOffset();
	
		for ($nb = 1; $nb <= parent::getNbPoints(); $nb++) {
			$coord[] = array("x" => $x, "y" => $y);
			$nx = Formula::getX($r, $rotation['sens'] * $rotation['angle']);
			$ny = Formula::getY($r, $rotation['sens'] * $rotation['angle']);
	
			$x -= $nx;
			$y -= $ny;
		}
	
		parent::setLastCoord(end($coord));
		return $coord;
	}
}

?>