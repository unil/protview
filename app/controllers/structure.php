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
		if (!isset($this->params['id'])) throw new xException('No subunit id provided', 400);

		$peptide_id = $this->params['id'];
		
		$items = array();
		
		$regions = xModel::load(
				'region',
				array(
						'xjoin' => '',
						'peptide_id' => $peptide_id, //where
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
		if (!isset($items['terminusN'])) throw new xException('No n-terminus provided', 400);
		if (!isset($items['terminusC'])) throw new xException('No c-terminus provided', 400);
		
		
		
		$sequence = strtoupper(trim($items['sequence']));
		
		$membraneRegions = ($items['membraneRegions']);
		$terminusN = $items['terminusN'];
		$terminusC = $items['terminusC'];
		
		$aaCount = strlen($sequence);
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
				$region['start'] = $start;
				$region['end'] = $end;
				$region['type'] = $type;
				$region['pos'] = $pos;
				$regions[] = $region;
				$region = array();
				$pos++;
			}
			
			//membrane region
			$region['start'] = $currentRegion['start'];
			$region['end'] = $currentRegion['end'];
			$region['type'] = 'membrane';
			$region['pos'] = $pos;
			$regions[] = $region;
			$pos++;
			
			if ($type == 'intra')
				$type = 'extra';
			else
				$type = 'extra';
			
			$start = $currentRegion['end'] + 1;			
		}
		
		//if there are more aa to distribute, add an other domain
		if ($aaCount - $start > 0) {
			$region['start'] = $start;
			$region['end'] = $aaCount - $start;
			$region['type'] = $type;
			$region['pos'] = $pos;
			$regions[] = $region;
			$region = array();
		}
		
		/*if ($type != $terminusC)
			throw new xException('No n/c-terminus are not correct for regions specified', 400);*/
		
		$r = $regions;
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
		
		//Create protein
		$protein = new Protein("Random protein", "Homo sapiens");
		$protein->setNote("The following is a valid extended BIOML file");
		
		//Create subunit
		$subunit = new Subunit(1);
		$subunit->setName("alpha-1 isoform a");
		
		//Create peptide
		$peptide = new Peptide(1, 1, 110);
		
		//Initialize amino acid counter (id)
		$count = 1;
		//Reade sequence and create amino acid class for each value
		//increases id by one for each amino acid
		//adds amino acids to a domain
		
		$elements = str_split($sequence);
		
		for ($d = 0; $d < count($domains); $d++) {
		$dom = $domains[$d];
		
		$start = $dom['start'];
		$end = $dom['end'];
		$type = $dom['type'];
		
		$domain = new Domain($d+1, $start, $end, $type);
		
		for ($s = $start; $s <= $end; $s++) {
		$domain->addAminoAcid(new AminoAcid($s, $elements[$s]));
		$count++;
		}
		$peptide->addDomain($domain);
		
		}*/
		
		// Database action
		//$r = xModel::load($this->model, $this->params['items'])->post();
		// Result
		return $r;
	}
	
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
		
		
		
		$sequence = strtoupper($items['sequence']);
		
		$membraneRegions = ($items['membraneRegions']);
		
		$r = $membraneRegions;
		
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
		
		//Create protein
		$protein = new Protein("Random protein", "Homo sapiens");
		$protein->setNote("The following is a valid extended BIOML file");
		
		//Create subunit
		$subunit = new Subunit(1);
		$subunit->setName("alpha-1 isoform a");
		
		//Create peptide
		$peptide = new Peptide(1, 1, 110);
		
		//Initialize amino acid counter (id)
		$count = 1;
		//Reade sequence and create amino acid class for each value
		//increases id by one for each amino acid
		//adds amino acids to a domain
		
		$elements = str_split($sequence);
		
		for ($d = 0; $d < count($domains); $d++) {
			$dom = $domains[$d];
		
			$start = $dom['start'];
			$end = $dom['end'];
			$type = $dom['type'];
		
			$domain = new Domain($d+1, $start, $end, $type);
		
			for ($s = $start; $s <= $end; $s++) {
				$domain->addAminoAcid(new AminoAcid($s, $elements[$s]));
				$count++;
			}
			$peptide->addDomain($domain);
		
		}*/
		
		// Database action
		//$r = xModel::load($this->model, $this->params['items'])->post();
		// Result
		return $r;
	}
}