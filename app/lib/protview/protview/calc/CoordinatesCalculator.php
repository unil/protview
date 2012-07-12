<?php

require_once('CalcHelper.php');

class CoordinatesCalculator {
	private $scatterSize;
	private $sequenceLength;
	private $startCoord;
	private $endCoord;

	public function __construct($scatterSize, $startCoord = null) {
		$this->scatterSize = $scatterSize;

		if ($startCoord == null)
			$this->startCoord = array("x" => 0, "y" => 0);
		else
			$this->startCoord = $startCoord;
	}

	public function setScatterSize($scatterSizer) {
		$this->scatterSize = $scatterSize;
	}

	public function setSequenceLength($sequenceLength) {
		$this->sequenceLength = $sequenceLength;
	}

	public function setStartCoord($startCoord) {
		$this->startCoord = $startCoord;
	}

	public function getEndCoord() {
		return $this->endCoord;
	}

	/**
	 * Calcultes the coordinates of each point on the cercle's
	 * perimeter 
	 * 
	 * Rotation sens and degrees can be specified
	 * Points can be a scatter point and the distance beetween each point
	 * is equal to the scatter's diameter
	 * 
	 * Thanks to http://php.net/manual/ro/function.atan2.php 
	 * (comment Monte Shaffer 08-Jun-2007 11:35)
	 * 
	 * @param int $rotationSense (1 = bottom->up; -1 = top->down)
	 * @param int $degree (360° = cercle; default 180 = arc)
	 * 
	 * @return array (coordinates of each point on the perimeter)
	 */
	public function calculateCercle($rotationSens = 1, $degree = 180) {
		$coord = array();

		/* calculates the cercle's radius
		 * 
		 * r = perimeter / pi
		 * 
		 * perimeter = scatterSize * sequenceLength
		 */
		$r = $this->scatterSize * $this->sequenceLength / M_PI;

		/*
		 * calculates spaces between each point
		 * 
		 * degrees / number of elements
		 */
		$offset = $degree/$this->sequenceLength;

		for ($angle = $degree; $angle >= 0; $angle -= $offset)	 {
			$nx = CalcHelper::getX($r, $rotationSens*$angle);
			$ny = CalcHelper::getY($r, $rotationSens*$angle);
				
			$x = $this->startCoord['x'] + $nx + $r;
			$y = $this->startCoord['y'] - $ny;

			$coord[] = array("x" => $x, "y" => $y);
		}
		$this->endCoord = end($coord);

		return $coord;
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
	public function calculateLine($rotationSens = 1, $angle = 90) {
		$coord = array();
		
		$x = $this->startCoord['x'];
		$y = $this->startCoord['y'];

		$r = $this->scatterSize;
		
		for ($nb = 1; $nb <= $this->sequenceLength; $nb++) {
				$nx = CalcHelper::getX($r, $rotationSens*$angle);
				$ny = CalcHelper::getY($r, $rotationSens*$angle);
				
				$x -= $nx;
				$y -= $ny;

			$coord[] = array("x" => $x, "y" => $y);
		}

		$this->endCoord = end($coord);
		return $coord;
	}
}

?>
