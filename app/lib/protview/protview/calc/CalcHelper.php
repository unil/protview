<?php

class CalcHelper {
	
	/**
	 * Calculates y coordinate
	 * @param int $offset (distance to add to result)
	 * @param int $angle (rotation angle 0-360 degree)
	 */
	public static function getY($offset, $angle) {
		$y = number_format($offset * sin(deg2rad($angle)),0);
		return $y;
	}
	
	/**
	 * Calculates x coordinate
	 * @param int $offset (distance to add to result)
	 * @param int $angle (rotation angle 0-360 degree)
	 */
	public static function getX($offset, $angle) {
		$x = number_format($offset * cos(deg2rad($angle)),0);
		
		return $x;
	}
}

?>