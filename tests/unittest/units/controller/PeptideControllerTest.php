<?php
/**
 * Tests ProteinController class
 * Test are made at xModel level.
 * @package unittests
 */
class PeptideControllerTest extends protviewPHPUnit_Framework_TestCase {

	/*function test_proteinController_get_allFieldsAreReturned() {
		$ret = xFront::load('api', array('xcontroller' => 'structure', 'id' => 1, 'xformat' => 'json'))->get();		
		print_r($ret);
	}*/
	
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
									array('id' => 0, 'start' => 58, 'end' => 157)
									)
							)
				))->put();
		print_r($ret);
	}
}
?>