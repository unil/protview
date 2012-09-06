<?php
require_once(xContext::$basepath.'/lib/protview/protview/geom/Formula.php');
/**
 * Base class for all shape types
 *
 * @abstract
 * @package protview\geom\shape
 * @author Stefan Meier
 * @version 20120906
 *
 */
abstract class Shape {
	private $offset;
	private $startCoord;
	private $lastCoord;
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
	

	/**
	 * Defines distance between each point
	 * @param array $offset
	 */
	public function setOffset($offset) {
		$this->offset = $offset;
	}
	
	public function getOffset() {
		return $this->offset;
	}
	
	/**
	 * Sets start coordinates
	 *
	 * <code>
	 * array('x' => float, 'y' => float);
	 * </code>
	 *
	 * @param array $startCoord
	 */
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
	
	/**
	 * Returns coordinates of last point
	 * @return array
	 */
	public function getLastCoord() {
		return $this->lastCoord;
	}
	
	public function getRotation()
	{
		return $this->rotation;
	}
	
	/**
	 * Sets shape rotation
	 *
	 * <code>
	 * array('angle' => 90, sens => 1)
	 * </code>
	 * @param array $rotation
	 */
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
