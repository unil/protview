<?php

class RepresentationController extends RESTController {
	function defaultAction() {
		$data = array();
		return xView::load('drawingboard/start', $data, $this->meta)->render();
	}
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
		if (!isset($items['id'])) throw new xException('No id provided', 400);
		
		require_once(xContext::$basepath.'/lib/protview/protview/bio/Protein.php');
		require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/TransmembraneProtein.php');
		
		
		
		$offsetX = 80;
		$offsetY = 380;
		
		//number of aa
		$length = 24;
		$size = 20;
		
		$startCoord = array("x" => 0, "y" => 0);
		

		
		
		/*Create protein test*/
		$sequence = "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		
		$domains = array(
				array('start' => 1, 'end' => 24, 'type' => 'extra'),
				array('start' => 25, 'end' => 46, 'type' => 'trans'),
				array('start' => 47, 'end' => 60, 'type' => 'intra'),
				array('start' => 61, 'end' => 80, 'type' => 'trans'),
				array('start' => 81, 'end' => 120, 'type' => 'extra'),
				array('start' => 121, 'end' => 150, 'type' => 'trans'),
				array('start' => 151, 'end' => 300, 'type' => 'intra'),
				array('start' => 301, 'end' => 318, 'type' => 'trans'),
				array('start' => 319, 'end' => 340, 'type' => 'extra')
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
		
		}
		
		$subunit->addPeptide($peptide);
		$protein->addSubunit($subunit);
		
		$proteinCalc = new TransmembraneProtein($protein, $startCoord, $size);
		
		$coords = $proteinCalc->getAACoordinates();
		$membraneCoords = $proteinCalc->getMembraneCoordinates();
		
		
		

		
	}
}