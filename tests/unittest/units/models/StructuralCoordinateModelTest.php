<?php
/**
 * Tests StructuralCoordinate Model class
 * Test are made at xModel level.
 * @package unittests
 */
class StructuralCoordinateModelTest extends protviewPHPUnit_Framework_TestCase {

	/*function test_structuralCoordinateModel_get_allFieldsAreReturned() {
		$ret = xModel::load('structural-coordinate', array())->get(0);		
		print_r($ret);
		$this->assertTrue(array_key_exists('id', $ret));
	}*/
	/*
	 * array (
	    	array(
	    			'id' => 1,
	    			'region_id' => 1,
	    			'representation_id' => 1,
	    			'type' => 'cercle',
	    			'pos' => 2,
	    			'labels' => array(
	    					'A-101',
	    					'B-203'
	    					),
	    			'params' => array(
	    					'rotation' => 180,
	    					'sens' => 1
	    					),
	    			'coordinates' => array(
	    						array(
	    							'id' =>　1,
	    							'x' => 12.23,
	    							'y' => 123.34,
	    							'amino_acid_id' => 123
	    						)
	    			)
	    	),
	    	            [id] => 3
            [structural_geometry_id] => 1
            [amino_acid_id] => 3
            [coordinate] => 1.23/2435.2345
            [amino-acid_id] => 3
            [amino-acid_region_id] => 1
            [amino-acid_type] => c
            [amino-acid_link] => 
            [amino-acid_modification] => 
            [amino-acid_pos] => 3
	 */
	function test_structuralCoordantesModel_toJSON() {
		$ret = xModel::load('structural-geometry', array('xjoin' => 'region'))->get();
		//$ret = xModel::load('structural-coordinate', array('xjoin' => 'amino-acid'))->get();
		print_r($ret);
	}
}
?>