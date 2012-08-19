<?php

class RepresentationsController extends RESTController {
	function get() {
		$ret = array();
		$items = array();
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
			$r['id'] = (int)$r['id'];
			$r['region_id'] = (int)$r['region_id'];
			$r['representation_id'] = (int)$r['representation_id'];
			$r['pos'] = (int)$r['pos'];
			
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
						'id' => (int)$coord['id'],
						'x' => (double)$xy[0],
						'y' => (double)$xy[1],
						'amino_acid_id' => (int)$coord['amino_acid_id']
				);
				$coordinates[] = $coordinate;
			}
			$r['labels'] = $labels;
			$r['coordinates'] = $coordinates;
			$items[] = $r;
		}
		$ret['items'] = $items;
		return $ret;
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
		echo "peptide_id: {$items['peptide_id']}";
		if (!isset($items['peptide_id'])) throw new xException('No peptide_id provided', 400);
		
		$peptide_id = $items['peptide_id'];
		
		require_once(xContext::$basepath.'/lib/protview/protview/bio/Peptide.php');
		require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/PeptideShape.php');
		
		
		$size = 20;
		
		$startCoord = array("x" => 0, "y" => 0);
		

		$pept = xController::load(
				'peptides',
				array(
						'id' => $peptide_id, //where
						'xorder' => 'pos',
						'allRegions'
				)
		)->get();
		
		$sequence = $pept['sequence'];
		$regions = $pept['regions'];
				
		
		
		//Create peptide
		$peptide = new Peptide($pept['id'], 0, 0);
		
		//Initialize amino acid counter (id)
		$count = 1;
		//Reade sequence and create amino acid class for each value
		//increases id by one for each amino acid
		//adds amino acids to a domain
		
		$elements = str_split($sequence);
		
		for ($d = 0; $d < count($regions); $d++) {
			$dom = $regions[$d];
		
			$start = $dom['start'];
			$end = $dom['end'];
			$type = $dom['type'];
		
			$region = new Region($d+1, $start, $end, $type);
		
			for ($s = $start; $s <= $end; $s++) {
				$region->addAminoAcid(new AminoAcid($s, $elements[$s]));
				$count++;
			}
			$peptide->addRegion($region);
		
		}
		
		
		$proteinCalc = new TransmembraneProtein($peptide, $startCoord, $size);
		
		$coords = $proteinCalc->getAACoordinates();
		$membraneCoords = $proteinCalc->getMembraneCoordinates();
		
		
		return $pept;
	}
}