<?php
/**
 * Tests Bioml class.
 * Test are made at xModel level.
 * @package unittests
 */
class BiomlTest extends protviewPHPUnit_Framework_TestCase {

	function test_bioml_controller_get() {
		//$c = xController::load('bioml')->get();
		//$f = xFront::load('api')->encode_xml($c);
		$f = xFront::load('api', array('xcontroller' => 'bioml', 'xmethod' => 'get', 'xformat' => 'xml'))->get();
		echo $f;
		$this->assertFalse(false);
	}
}
?>