<?php
/**
 * Formulas for geometries
 *
 * @package protview\geom
 * @author Stefan Meier
 * @version 20120906
 *
 */
class Formula {

	
	/*
	 * Trigonometric formulas
	 */
	
	/**
	 * Calculates y coordinate for each point on a cercle
	 * @param int $radius
	 * @param int $angle (rotation angle 0-360 degree)
	 */
	public static function getY($radius, $angle) {
		$y = $radius * sin(deg2rad($angle));
		return $y;
	}

	/**
	 * Calculates x coordinate for each point on a cercle
	 * @param int $radius
	 * @param int $angle (rotation angle 0-360 degree)
	 */
	public static function getX($radius, $angle) {
		$x = $radius * cos(deg2rad($angle));
		return $x;
	}
}

?>