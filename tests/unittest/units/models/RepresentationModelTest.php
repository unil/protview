<?php
/**
 * Tests Representation Model class
 * Test are made at xModel level.
 * @package unittests
 */
class ProteinModelTest extends protviewPHPUnit_Framework_TestCase {

	function test_representationModel_get_allFieldsAreReturned() {
		$ret = xModel::load('representation', array())->get(0);		
		print_r($ret);
		$this->assertTrue(array_key_exists('id', $ret));
	}
}
?>