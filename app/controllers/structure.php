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
		/*$items = array(
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
		*/
		$items = array();
		
		$regions = xModel::load(
				'region',
				array(
						'xjoin' => '',
						'peptide_id' => 1, //where
						'xorder' => 'pos'
				)
		)->get();
		
		$sequence = "";
		$terminusN = null;
		$terminusC = null;
		
		$count = count($regions);
		$r = 0;
		$start = 0;
		$end = 0;
		$membraneRegions = array();
		
		foreach($regions as $region) {
			
			//first region determines terminusN
			if ($terminusN == null) {
				$terminusN = $region['type'];
			}
			//last region determines terminusC
			if ($r + 1 >= $count) {
				$terminusC = $region['type'];
			}
			
			
			$amino_acids = xModel::load(
					'amino-acid',
					array(
							'xjoin' => '',
							'region_id' => $region['id'], //where
							'xorder' => 'pos'
					)
			)->get();
			
			$nbAA = count($amino_acids);
			$end += $start + $nbAA;
			
			foreach($amino_acids as $aa) {
				$sequence .= $aa['type'];
			}
			$r++;
			
			
			if ($region['type'] == 'membrane') {
				$membraneRegion = array();
				
				$membraneRegion['region_id'] = $region['id'];
				$membraneRegion['start'] = $start;
				$membraneRegion['end'] = $end;
				
				$membraneRegions[] = $membraneRegion;
			}
			$start = $end;
		}
		$items['sequence'] = $sequence;
		$items['terminusN'] = $terminusN;
		$items['terminusC'] = $terminusC;
		$items['membraneRegions'] = $membraneRegions;
		
		return $data['items'] = $items;
	}
}