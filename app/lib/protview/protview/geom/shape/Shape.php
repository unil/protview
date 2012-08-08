<?php
require_once(xContext::$basepath.'/lib/protview/protview/geom/Formula.php');
abstract class Shape {
	//distance between each point
	private $offset;
	private $startCoord;
	private $lastCoord;
	/*
	 * array('angle' => 90, sens => 1)
	 */
	private $rotation;
	
	
	public function __construct($offset, $startCoord = null) {
		$this->setOffset($offset);
		$this->setStartCoord($startCoord);
		$this->setLastCoord($this->getStartCoord());
		$this->setRotation(null);
		
		if ($this->getOffset() < 0)
			throw new Exception("Offset needs to be greater or equal to 0 but is '{$this->getOffset()}'.");
		
		if ($this->getStartCoord() == null || 
				!is_array($this->getStartCoord()) || 
				!array_key_exists('x', $this->getStartCoord()) || 
				!array_key_exists('y', $this->getStartCoord()))
			throw new Exception("Start Coord is invalid '" . print_r($this->getStartCoord()) . "'.");
	}
	
	public function setOffset($offset) {
		$this->offset = $offset;
	}
	
	public function getOffset() {
		return $this->offset;
	}
	
	public function setStartCoord($startCoord) {
		if ($startCoord == null) {
			$this->startCoord = array("x" => 0, "y" => 0);
		}
		else if (is_array($startCoord)) {
		
			if (array_key_exists('x', $startCoord)) {
				$this->startCoord['x'] = $startCoord['x'];
			}
		if (array_key_exists('y', $startCoord)) {
				$this->startCoord['y'] = $startCoord['y'];
			}
		}
	}
	
	public function getStartCoord()
	{
		return $this->startCoord;
	}
	
	public function setLastCoord($lastCoord) {
		$this->lastCoord = $lastCoord;
	}
	
	public function getLastCoord() {
		return $this->lastCoord;
	}
	
	public function getRotation()
	{
		return $this->rotation;
	}
	
	public function setRotation($rotation)
	{
		if ($rotation == null ) {
			$this->rotation = array('angle' => 0, 'sens' => 1);
		}
		else if	(is_array($rotation)) {

			if (array_key_exists('angle', $rotation)) {
				
				$this->rotation['angle'] = $rotation['angle'];
			}
			if (array_key_exists('sens', $rotation)) {
				$this->rotation['sens'] = $rotation['sens'];
			}
		}
	}
	
	abstract function getCoord();
}

?>
