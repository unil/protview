<?php

class StructuralGeometriesController extends RESTController {
    function get() {
    	$ret = 
    	array (
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
    		array(
    				'id' => 2,
    				'region_id' => 1,
    				'representation_id' => 1,
    				'type' => 'cercle',
    				'pos' => 1,
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
    		)
    	);
    	return $ret;
    }
}