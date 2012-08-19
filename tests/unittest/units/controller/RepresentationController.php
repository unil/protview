<?php
/**
 * Tests RepresentationController class
 * Test are made at xModel level.
 * @package unittests
 */
class RepresentationsControllerTest extends protviewPHPUnit_Framework_TestCase {

	
	function test_peptideController_put_allFieldsAreReturned() {
		$ret = xController::load(
				'representations', array(
					'items' => array (
							'peptide_id' => 1							
							)
				))->put();
		print_r($ret);
	}
}
?>