<?php
/**
 * Tests ProteinController class
 * Test are made at xModel level.
 * @package unittests
 */
class ProteinControllerTest extends protviewPHPUnit_Framework_TestCase {

	function test_proteinController_get_allFieldsAreReturned() {
		echo 'test_proteinController_get_allFieldsAreReturned';
		$ret = xController::load('proteins', array())->get();		
		print_r($ret);
	}
	
	function test_proteinController_put_noErrorExpected() {
		echo 'test_proteinController_put_noErrorExpected';
		$ret = xController::load(
				'proteins', array(
					'items' => array (
							'id' => 0,
							'name' => 'protein 4',
							'species' => 'homo sapiens',
							'note' => null
							)
				))->put();
		print_r($ret);
	}
	
	function test_proteinController_delete_oneFieldDeletedWithNoError() {
		echo 'test_proteinController_delete_oneFieldDeletedWithNoError';
		$ret = xController::load(
				'proteins', array(
					'id' => 2		
				))->delete();
		print_r($ret);
	}
	
	function test_proteinController_post_noErrorExpected() {
		echo 'test_proteinController_post_noErrorExpected';
		$ret = xController::load(
				'proteins', array(
						'id' => 1,
						'items' => array (
								'id' => 1,
								'name' => 'protein 4',
								'species' => 'homo sapiens',
								'note' => null
						)
				))->post();
		print_r($ret);
	}
}
?>