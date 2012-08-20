<?php
/**
 * Tests ProteinController class
 * Test are made at xModel level.
 * @package unittests
 */
class PeptideControllerTest extends protviewPHPUnit_Framework_TestCase {

	/*function test_peptideController_get_allFieldsViaFrontAsJSON() {
		$ret = xFront::load('api', array('xcontroller' => 'peptides', 'id' => 1, 'xformat' => 'json'))->get();		
		print_r($ret);
	}*/
	
	function test_peptideController_get_allFields() {
		$ret = xController::load('peptides', array('id' => 1, 'allRegions' => 'allRegions'))->get();
		print_r($ret);
	}
	
	/*
	 * "items": {
        "id": 1,
        "sequence": "abcdefghijklmnopqr",
        "terminusN": "int",
        "terminusC": "int",
        "membraneRegions": [
            {
                "id": "2",
                "start": "18",
                "end": "36"
            },
            {
                "id": "0",
                "start": "23",
                "end": "45"
            }
        ]
    }
	 */
	function test_peptideController_put_allFieldsAreReturned() {
		$sequence = "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";

		$ret = xController::load(
				'peptides', array(
					'items' => array (
							'peptide_id' => 1,
							'sequence' => $sequence,
							'terminusN' => 'intra',
							'terminusC' => 'intra',
							'membraneRegions' => array(
									array('id' => 2, 'start' => 18, 'end' => 36),
									array('id' => 0, 'start' => 58, 'end' => 78)
									)
							)
				))->put();
		print_r($ret);
	}
	
	//xfm problem, cannot delete by foreign_key
	/*function test_peptideController_delete_allFieldsAreReturned() {
		$ret = xController::load(
			'peptides', array(
					'id' => 1,
			))->delete();
		print_r($ret);
	}*/
	
	
}
?>