<?php

class StructuralGeometriesController extends xWebController {

    /*function defaultAction() {
        return xView::load('home/home', $data)->render();
    }*/
    /*
     *

	structuralGeometries : [
		{
			id : 1,
			region_id : 1,
			representation_id : 1,
			type: 'circle',
			pos: 1,
			labels : {
				1: 'A-101',
				2: 'B-2'3'
			}
			params : {
				rotation : 180,
				sens : 1
			},
			coordinates : [
				{
					id: 1,
					x: 12.23,
					y: 124.34,
					amino_acid_id : 123
				}
			]
		}
	],
     */
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