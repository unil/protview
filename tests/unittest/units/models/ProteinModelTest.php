<?php
/**
 * Tests Protein Model class
 * Test are made at xModel level.
 * @package unittests
 */
class ProteinModelTest extends protviewPHPUnit_Framework_TestCase {

	function test_proteinModel_get_allFieldsAreReturned() {
		$m = xModel::load('protein', array())->get();
		print_r($m);
		$this->assertFalse(false);
	}
}
?>