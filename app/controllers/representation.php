<?php

class RepresentationController extends xWebController {

    /*function defaultAction() {
        return xView::load('home/home', $data)->render();
    }*/
    /*
     * {

	regions : [
		{
			id: 1,
			label: 'region 1',
			type: 'trans-membrane',
			start: 0,
			end : 120,
			sequence : [
				{id: 1, aa: 'L', mod: 'p', link: 12, geomRef: {geometrie_id: 1, pos: 12}}
			],
			geometries: [
				{
					id : 1,
					type: cercle, 
					coord: [
							{x: 12.23, y: 123.124},
							{x: 12.23, y: 123.124}
					]
				}
			]
		}
	]

}
     */
    function get() {
    	$ret = array(
    			'region' => array(
    					array('id' => 1,
    						   'label' => 'region 1',
    							'type' => 'transmembrane',
    							'start' => 0,
    							'end' => 120,
    							'sequence' => array(
    									array(
    											'id' => 1,
    											'aa' => 'L',
    											'mod' => 'p',
    											'link' => 12,
    											'geomRef' => array(
    													'geometrie_id' => 1,
    													'pos' => 12
    													)
    											)
    									),
    							'geometrie'=> array (
    									array (
    											'id' => 1,
    											'type' => 'cercle',
    											'coords' => array (
    													array ('x' => 12.23, 'y' => 123.348)
    													)
    											)
    									)	
    							)
    					)
    			);
    	return $ret;
    }
}