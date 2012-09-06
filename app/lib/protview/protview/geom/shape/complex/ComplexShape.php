<?php
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/BasicShape.php');
/**
 * Complex Shape
 * 
 * Abstract class to separate basic shapes from complex shapes
 *
 * @abstract
 * @package protview\geom\shape\complex
 * @author Stefan Meier
 * @version 20120906
 *
 */
abstract class ComplexShape extends Shape {
	public function __construct($offset, $startCoord = null) {
		parent::__construct($offset, $startCoord);
	}
}

?>