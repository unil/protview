<?php
/**
 * Tests ProteinController class
 * Test are made at xModel level.
 * @package unittests
 */
class ProteinControllerTest extends protviewPHPUnit_Framework_TestCase {

	function test_proteinController_get_allFieldsAreReturned() {
		$ret = xController::load('protein', array())->get();		
		print_r($ret);
	}
	
	function test_proteinController_put_allFieldsAreReturned() {
		$ret = xController::load(
				'proteins', array(
					'id' => 0,
					'items' => array (
							'id' => 0,
							'name' => 'protein 3',
							'species' => 'homo sapiens',
							'note' => null
							)
				))->put();
		print_r($ret);
	}
}
?>