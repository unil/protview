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
		// Checks if method is allowed
		if (!in_array('get', $this->allow)) throw new xException("Method not allowed", 403);
		// Checks if id is provided as this is madatory
		if (!isset($this->params['id'])) throw new xException('No peptide id provided', 400);

		$peptide_id = $this->params['id'];
		
		$items = array();
		
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
		$start = 0;
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
			$end += $start + $nbAA;
			
			foreach($amino_acids['items'] as $aa) {
				$sequence .= $aa['type'];
			}
			$r++;
			
			
			if ($region['type'] == 'membrane') {
				$membraneRegion = array();
				
				$membraneRegion['id'] = (int)$region['id'];
				$membraneRegion['start'] = (int)$start;
				$membraneRegion['end'] = (int)$end;
				
				$membraneRegions[] = $membraneRegion;
			}
			$start = $end;
		}
		$items['id'] = $peptide_id;
		$items['sequence'] = $sequence;
		$items['terminusN'] = $terminusN;
		$items['terminusC'] = $terminusC;
		$items['membraneRegions'] = $membraneRegions;
		
		return $data['items'] = $items;
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
	function post() {
		//$this->delete();
		//$this->put();
		
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
				$region['aas'] = $this->getAA($aaArray, $region);
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
			$region['aas'] = $this->getAA($aaArray, $region);
			$regions[] = $region;
			$pos++;
			
			if ($type == 'intra')
				$type = 'extra';
			else
				$type = 'intra';
			
			$start = $currentRegion['end'] + 1;			
		}
		
		//if there are more aa to distribute, add an other domain
		if ($aaCount - $start > 0) {
			$region['start'] = $start;
			$region['end'] = $aaCount;
			$region['type'] = $type;
			$region['pos'] = $pos;
			$regions[] = $region;
			$region = array();
		}
		
		if ($type != $terminusC)
			throw new xException('No N/C-Terminus are not correct for regions specified', 400);
		
		$r['items'] = $regions;

		/*$domains = array(
		 array('start' => 1, 'end' => 24, 'type' => 'extra'),
				array('start' => 25, 'end' => 46, 'type' => 'trans'),
				array('start' => 47, 'end' => 60, 'type' => 'intra'),
				array('start' => 61, 'end' => 80, 'type' => 'trans'),
				array('start' => 81, 'end' => 120, 'type' => 'extra'),
				array('start' => 121, 'end' => 150, 'type' => 'trans'),
				array('start' => 151, 'end' => 300, 'type' => 'intra'),
				array('start' => 301, 'end' => 318, 'type' => 'trans'),
				array('start' => 319, 'end' => 340, 'type' => 'extra'),
		
		);
		*/		
		
		
		// Database action
		//$r = xModel::load($this->model, $this->params['items'])->post();
		// Result
		return $r;
	}
	
	//Read sequence and take amino acid each value
	//increases it's pos
	//adds amino acids to the correction region
	private function getAA($aaArray, $region) {
		$aas = array();
		$start = $region['start'];
		$end = $region['end'];
		$region_id = $region['id'];
			
		for ($s = $start; $s <= $end; $s++) {
			$aa = array();
			$aa['id'] = 0;
			$aa['pos'] = $s;
			$aa['type'] = $aaArray[$s];
			$aa['region_id'] = $region_id;
			
			$aas[] = $aa;
		}	
		return $aas;	
	}
}