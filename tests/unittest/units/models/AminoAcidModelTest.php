<?php
/**
 * Tests AminoAcid Model class
 * Test are made at xModel level.
 * @package unittests
 */
class AminoAcidModelTest extends protviewPHPUnit_Framework_TestCase {

	function test_aminioAcidModel_get_allFieldsAreReturned() {
		$ret = xModel::load('amino-acid', array())->get(0);		
		print_r($ret);
		$this->assertTrue(array_key_exists('id', $ret));
	}
}
?>