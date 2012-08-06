<?php
/**
 * Tests StructuralCoordinate Model class
 * Test are made at xModel level.
 * @package unittests
 */
class StructuralCoordinateModelTest extends protviewPHPUnit_Framework_TestCase {

	function test_structuralCoordinateModel_get_allFieldsAreReturned() {
		$ret = xModel::load('structural-coordinate', array())->get(0);		
		print_r($ret);
		$this->assertTrue(array_key_exists('id', $ret));
	}
}
?>