<?php

class StructureController extends RESTController {
	function defaultAction() {
		$data = array();
		return xView::load('structure/structure', $data, $this->meta)->render();
	}
	/*
	 * {
	sequence: 'asdf',
	terminusN: 'ext',
	terminusC: 'int',
	membraneRegions: [
		{id: 1, start: 1, end: 234},
		{id: 4, start: 500, end: 600}
	]
}
	 */
	function get() {
		$items = array(
				'peptide_id' => 1,
				'sequence' => 'aaaaaabbbbddcc',
				'terminusN' => 'ext',
				'terminusC' => 'ext',
				'membraneRegions' => array(
							array(
								'region_id' => 1,
								'start' => 1,
								'end' => 234
							),
							array(
								'region_id' => 5,
								'start' => 500,
								'end' => 600
							)
						)
				);
		

		
		return $data['items'] = $items;
	}
}