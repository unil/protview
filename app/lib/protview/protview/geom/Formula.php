<?php

class Formula {

	
	/*
	 * Trigonometric formulas
	 */
	
	/**
	 * Calculates y coordinate
	 * @param int $radius
	 * @param int $angle (rotation angle 0-360 degree)
	 */
	public static function getY($radius, $angle) {
		$y = $radius * sin(deg2rad($angle));
		return $y;
	}

	/**
	 * Calculates x coordinate
	 * @param int $radius
	 * @param int $angle (rotation angle 0-360 degree)
	 */
	public static function getX($radius, $angle) {
		$x = $radius * cos(deg2rad($angle));
		return $x;
	}
}

?>