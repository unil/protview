<?php
/**
 * Tests RegionController class
 * Test are made at xModel level.
 * @package unittests
 */
class RegionControllerTest extends protviewPHPUnit_Framework_TestCase {

	function test_regionController_delete_fromSpecifiedPeptide() {
		$ret = xController::load(
				'regions', array(
						'peptide_id' => 1
				))->delete();
		print_r($ret);
	}
	
	
}
?>