<?php
/**
 * Tests Region Model class
 * Test are made at xModel level.
 * @package unittests
 */
class RegionModelTest extends protviewPHPUnit_Framework_TestCase {

	function test_regionModel_get_allFieldsAreReturned() {
		$ret = xModel::load('region', array())->get(0);		
		print_r($ret);
		$this->assertTrue(array_key_exists('id', $ret));
	}
	
	function test_regionModel_delete_fromSpecifiedPeptide() {
		$ret = xController::load(
				'regions', array(
						'peptide_id' => $peptide_id
				))->delete();
		print_r($ret);
	}
}
?>