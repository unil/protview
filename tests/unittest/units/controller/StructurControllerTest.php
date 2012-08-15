<?php
/**
 * Tests ProteinController class
 * Test are made at xModel level.
 * @package unittests
 */
class StructureControllerTest extends protviewPHPUnit_Framework_TestCase {

	function test_proteinController_get_allFieldsAreReturned() {
		$ret = xFront::load('api', array('xcontroller' => 'structure', 'xformat' => 'json'))->get();		
		print_r($ret);
	}
}
?>