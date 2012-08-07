<?php
/**
 * Tests StructuralGeometry Model class
 * Test are made at xModel level.
 * @package unittests
 */
class StructuralGeometryModelTest extends protviewPHPUnit_Framework_TestCase {

	/*function test_structuralGeometryModel_get_allFieldsAreReturned() {
		$ret = xModel::load('structural-geometry', array())->get(0);		
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
		$ret = array();
		$geometries = xModel::load(
					'structural-geometry', 
					array(
						'xjoin' => 'region', 
						'representation_id' => 1, //where
						'xreturn' => array(
								'id',
								'region_id',
								'representation_id',
								'pos',
								'params',
								'structural_geometries.type'
						)
					)
				)->get();
		foreach($geometries as $geometry) {
			$r = $geometry;
			$coords = xModel::load(
						'structural-coordinate', 
						array(
							'xjoin' => 'amino-acid',
							'structural_geometry_id' => $geometry['id'],
							'xreturn' => array (
									'id',
									'amino_acid_id',
									'coordinate',
									'amino-acid_type',
									'amino-acid_pos'
							)	
						)
					)->get();
			$labels = array();
			$coordinates = array();
			foreach ($coords as $coord) {
				$labels[] = strtoupper($coord['amino-acid_type']) . "-" . strtoupper($coord['amino-acid_pos']);
				$xy = explode('/', $coord['coordinate']);
				$coordinate = array (
						'id' => $coord['id'],
						'x' => $xy[0],
						'y' => $xy[1],
						'amino_acid_id' => $coord['amino_acid_id']
						);
				$coordinates[] = $coordinate;
			}
			$r['labels'] = $labels;
			$r['coordinates'] = $coordinates;
			$ret[] = $r;
		}
		

		//$ret = xModel::load('structural-coordinate', array('xjoin' => 'amino-acid'))->get();
		print_r($ret);
	}
}
?>