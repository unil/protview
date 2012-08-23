<?php

class PeptidesController extends RESTController {
	public $model = 'peptide';
	function defaultAction() {
		$data = array();
		return xView::load('structure/peptide', $data, $this->meta)->render();
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
		// Checks if method is allowed
		if (!in_array('get', $this->allow)) throw new xException("Method not allowed", 403);

		$data = array();
		
		$peptide_id = $this->params['id'];
		//if true, all regions will be returned
		//otherwise, only membrane regions
		$regionFilter = array();
		
		if (isset($this->params['regions']))
			$regionFilter = explode(",", $this->params['regions']);
		
		//hack as for now one protein has exactly one subunit
		if (isset($this->params['protein_id']))
			$this->params['subunit_id'] = $this->params['protein_id'];

		$items = array();
		
		$peptides = xModel::load('peptide', $this->params)->get();
		
		
		foreach($peptides as $peptide) {
			$peptide_id = $peptide['id'];
			$item = array();
			$item['id'] = (int)$peptide_id;
			$item['subunit_id'] = (int)$peptide['subunit_id'];
			$item['label'] = $peptide['label'];
			$item['pos'] = $peptide['pos'];
			
			
			if (count($regionFilter) > 0) {
				$regions = xController::load(
						'regions',
						array(
								'xjoin' => '',
								'peptide_id' => $peptide_id, //where
								'xorder' => 'pos'
						)
				)->get();
		
				$sequence = "";
				$terminusN = null;
				$terminusC = null;
		
				$count = $regions['xcount'];
				$r = 0;
				$start = 1;
				$end = 0;
				$membraneRegions = array();
		
				foreach($regions['items'] as $region) {
						
					//first region determines terminusN
					if ($terminusN == null) {
						$terminusN = $region['type'];
					}
					//last region determines terminusC
					if ($r + 1 >= $count) {
						$terminusC = $region['type'];
					}
					$amino_acids = xController::load(
							'amino-acids',
							array(
									'xjoin' => '',
									'region_id' => $region['id'], //where
									'xorder' => 'pos'
							)
					)->get(); 
						
					$nbAA = $amino_acids['xcount'];
					$end = $start + $nbAA -1;
						
					foreach($amino_acids['items'] as $aa) {
						$sequence .= $aa['type'];
					}
					$r++;
						
					$membraneRegion = array();
					$membraneRegion['id'] = (int)$region['id'];
					$membraneRegion['start'] = (int)$start;
					$membraneRegion['end'] = (int)$end;
					$membraneRegion['type'] = $region['type'];
					
	
					if (in_array('all', $regionFilter) || in_array($region['type'], $regionFilter)) {
						$membraneRegions[] = $membraneRegion;
					}
						
					$start = $end + 1;
				}
				
				$item['sequence'] = $sequence;
				$item['terminusN'] = $terminusN;
				$item['terminusC'] = $terminusC;
				$item['regions'] = $membraneRegions;
			}
			$items[] = $item;
		}
		$data['xcount'] = count($peptides);
		$data['items'] = $items;

		return $data;
	}

	/*
	 * {
	"items": {
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
	}
	*/
	function put() {
		// Checks if method is allowed
		if (!in_array('put', $this->allow)) throw new xException("Method not allowed", 403);
		// Checks provided parameters
		if (!isset($this->params['items'])) throw new xException('No items provided', 400);
		// Checks for params.id and params.items.id consistency
		// (this test is only for precaution: params.id is not used in anyway)
		if (@$this->params['id'] != @$this->params['items']['id'])
			throw new xException("Parameters id and items.id do not match", 400);

		$items = $this->params['items'];
		if (!isset($items['sequence'])) throw new xException('No sequence provided', 400);
		if (!isset($items['membraneRegions'])) throw new xException('No membrane regions provided', 400);
		if (!isset($items['terminusN'])) throw new xException('No N-Terminus provided', 400);
		if (!isset($items['terminusC'])) throw new xException('No C-Terminus provided', 400);
		if (!isset($items['peptide_id'])) throw new xException('peptide_id cannot be null', 400);


		$peptide_id = $items['peptide_id'];
		$terminusN = $items['terminusN'];
		$terminusC = $items['terminusC'];

		if (!($terminusN == 'extra' || $terminusN == 'intra'))
			throw new xException('N-Terminus needs to be "extra" or "intra"', 400);

		if (!($terminusC == 'extra' || $terminusC == 'intra'))
			throw new xException('C-Terminus needs to be "extra" or "intra"', 400);

		$sequence = strtoupper(trim($items['sequence']));
		$aaArray = str_split($sequence);
		$membraneRegions = $items['membraneRegions'];

		$aaCount = count($aaArray);
		$start = 1;
		$end = 1;

		$pos = 1;
		$type = $terminusN;

		//in order to return items
		$r = array();

		$regions = array();
		for ($i = 0; $i < count($membraneRegions); $i++) {
			$currentRegion = $membraneRegions[$i];
			$region = array();
			/*evaluate number of aa between two membrane regions in order to
			 *determine the start/end value of the region betweeen
			*/
			$end = $currentRegion['start'] - 1;

			if ($end - $start > 0) {
				$region['id'] = 0;
				$region['start'] = $start;
				$region['end'] = $end;
				$region['type'] = $type;
				$region['pos'] = $pos;
				$regions[] = $region;
				$region = array();
				$pos++;
			}

			//membrane region
			$region['id'] = $currentRegion['id'];
			$region['start'] = $currentRegion['start'];
			$region['end'] = $currentRegion['end'];
			$region['type'] = 'membrane';
			$region['pos'] = $pos;
			$regions[] = $region;
			$pos++;

			if ($type == 'intra')
				$type = 'extra';
			else
				$type = 'intra';

			$start = $currentRegion['end'] + 1;
		}

		if ($aaCount - $start <= 0)
			throw new xException('Sequence is too short for indicate membrane regions.', 400);

		//distribute the last aa in a new region
		$region['start'] = $start;
		$region['end'] = $aaCount;
		$region['type'] = $type;
		$region['pos'] = $pos;
		$regions[] = $region;
		$region = array();


		if ($type != $terminusC)
			throw new xException('No N/C-Terminus are incorrect for regions specified (inside/outside missmatch)', 400);
		
		//delete old structure
		$deleteOldStructure = xModel::load(
				'region', array(
						'peptide_id' => $peptide_id
				))->delete();
		//$r['delete'] = $deleteOldStructure;
		
		//$r['regions'] = $regions;
		//$r['amino-acids'] = array();

		//insert into database
		foreach($regions as $region) {
			$retR = xController::load(
					'regions', array(
							'items' => array (
									'id' => 0, //new region id=0
									'peptide_id' => $peptide_id,
									'label' => null,
									'type' => $region['type'],
									'pos' => $region['pos']
							)
					))->put();
			//$r['regions'][] = $retR;
			$start = $region['start'];
			$end = $region['end'];

			//Read sequence and take amino acid each value
			//increases it's pos
			//adds amino acids to the correction region
			for ($s = $start-1; $s < $end; $s++) {
				$retA = xController::load(
						'amino-acids', array(
								'items' => array (
										'id' => 0, //new aa id=0
										'region_id' => $retR['xinsertid'],
										'type' => $aaArray[$s],
										'pos' => $s+1
								)
						))->put();
			}
			//$r['amino-acids'][] = $retA;
		}

		return $r;
	}
}