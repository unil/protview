<?php
/**
 * Tests OtherGeometry Model class
 * Test are made at xModel level.
 * @package unittests
 */
class OtherGeometryModelTest extends protviewPHPUnit_Framework_TestCase {

	function test_otherGeometryModel_get_allFieldsAreReturned() {
		$ret = xModel::load('other-geometry', array())->get(0);		
		print_r($ret);
		$this->assertTrue(array_key_exists('id', $ret));
	}
}
?>