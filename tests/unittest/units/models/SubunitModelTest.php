<?php
/**
 * Tests Subunit Model class
 * Test are made at xModel level.
 * @package unittests
 */
class SubunitModelTest extends protviewPHPUnit_Framework_TestCase {

	function test_subunitModel_get_allFieldsAreReturned() {
		$ret = xModel::load('subunit', array())->get(0);		
		print_r($ret);
		$this->assertTrue(array_key_exists('id', $ret));
	}
}
?>