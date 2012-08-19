<?php
/**
 * Tests Peptide Model class
 * Test are made at xModel level.
 * @package unittests
 */
class PeptideModelTest extends protviewPHPUnit_Framework_TestCase {

	function test_peptideModel_get_allFieldsAreReturned() {
		$ret = xModel::load('peptide', array())->get(0);		
		print_r($ret);
		$this->assertTrue(array_key_exists('id', $ret));
	}
	
	function test_peptideModel_delete_allFields() {
		$ret = xModel::load(
				'peptide', array(
						'id' => 1,
				))->delete();
		print_r($ret);
	}
}
?>