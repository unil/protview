<?php
require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/basic/BasicShape.php');

abstract class ComplexShape extends Shape {
	public function __construct($offset, $startCoord = null) {
		parent::__construct($offset, $startCoord);
	}
}

?>