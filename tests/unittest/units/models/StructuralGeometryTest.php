<?php
/**
 * Tests StructuralGeometry Model class
 * Test are made at xModel level.
 * @package unittests
 */
class StructuralGeometryModelTest extends protviewPHPUnit_Framework_TestCase {

	function test_structuralGeometryModel_get_allFieldsAreReturned() {
		$ret = xModel::load('structural-geometry', array())->get(0);		
		print_r($ret);
		$this->assertTrue(array_key_exists('id', $ret));
	}
}
?>