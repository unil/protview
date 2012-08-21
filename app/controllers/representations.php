<?php

class RepresentationsController extends RESTController {
	function get() {
		if (!in_array('get', $this->allow)) throw new xException("Method not allowed", 403);

		$data = array();


		//if true, all regions will be returned
		//otherwise, only membrane regions
		$detailFilter = array();

		if (isset($this->params['details']))
			$detailFilter = explode(",", $this->params['details']);



		$representations = xModel::load('representation', $this->params)->get();

		$data['xcount'] = count($representations);
		$items = array();

		foreach ($representations as $representation) {
			$item = array();
			$item['id'] = $representation['id'];
			$item['title'] = $representation['title'];

			$structuralGeometries = array();
			if (count($detailFilter) > 0) {
				if (in_array('all', $detailFilter) || in_array('structuralGeometries', $detailFilter)) {
					$geometries = xModel::load(
							'structural-geometry',
							array(
									'xjoin' => 'region',
									'representation_id' => $representation['id'], //where
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
						$structuralGeometries[] = $r;
					}
				}
			}
			$item['structuralGeometries'] = $structuralGeometries;
			$items[] = $item;
		}
		$data['items'] = $items;
		return $data;
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

		if (!isset($items['peptide_id'])) throw new xException('No peptide_id provided', 400);

		$peptide_id = $items['peptide_id'];

		$title = 'title';
		$description = 'description';
		$params = null;

		require_once(xContext::$basepath.'/lib/protview/protview/bio/Peptide.php');
		require_once(xContext::$basepath.'/lib/protview/protview/geom/shape/complex/PeptideShape.php');


		$size = 20;

		$startCoord = array("x" => 0, "y" => 0);


		$pept = xController::load(
				'peptides',
				array(
						'id' => $peptide_id, //where
						'xorder' => 'pos',
						'regions' => 'all'
				)
		)->get(0);

		$sequence = $pept['items'][0]['sequence'];
		$regions = $pept['items'][0]['regions'];



		//Create peptide
		$peptide = new Peptide($pept['items'][0]['id'], 0, 0);

		//Initialize amino acid counter (id)
		$count = 1;
		//Read sequence and create amino acid class for each value
		//increases id by one for each amino acid
		//adds amino acids to its region

		for ($d = 0; $d < count($regions); $d++) {
			$r = $regions[$d];

			$start = $r['start'];
			$end = $r['end'];
			$type = $r['type'];

			$region = new Region($r['id'], $start, $end, $type);

			$amino_acids = xController::load(
					'amino-acids',
					array(
							'xjoin' => '',
							'region_id' => $r['id'], //where
							'xorder' => 'pos'
					)
			)->get();

			$nbAA = $amino_acids['xcount'];

			foreach($amino_acids['items'] as $aa) {
				$region->addAminoAcid(new AminoAcid($aa['id'], $aa['type']));
			}

			$peptide->addRegion($region);
		}


		$proteinCalc = new PeptideShape($peptide, $startCoord, $size);

		$coords = $proteinCalc->getAACoordinates();
		$membraneCoords = $proteinCalc->getMembraneCoordinates();

		$coordPos = 0;
		//db insert
		$representation = xModel::load(
				'representation', array(
						'id' => 0,
						'title' => $title,
						'description' => $description,
						'params' => $params,
						'peptide_id' => $peptide_id
				))->put();
		foreach($peptide->getRegions() as $region) {

			$structural_geometry = xController::load(
					'structural-geometries', array(
							'items' => array (
									'id' => 0, //new aa id=0
									'representation_id' => $representation['xinsertid'],
									'region_id' => $region->getId(),
									'type' => 'undefined',
									'pos' => $region->getPos()
							)
					))->put();

			foreach($region->getAminoAcids() as $amino_acid) {



				if (isset($coords[$coordPos])) {
					$coordinate = $coords[$coordPos];
					$x = $coordinate['x'];
					$y = $coordinate['y'];
					xController::load(
							'structural-coordinates', array(
									'items' => array (
											'id' => 0, //new aa id=0
											'structural_geometry_id' => $structural_geometry['xinsertid'],
											'amino_acid_id' => $amino_acid->getId(),
											'coordinate' => $x . '/' . $y,
											'pos' => $amino_acid->getPos()
									)
							))->put();
				}
				$coordPos++;
			}
		}
	}
}