<?php
/**
 * Controls the representation model
 *
 * @package controllers
 * @author Stefan Meier
 * @version 20120903
 *
 */
class RepresentationsController extends RESTController {
	/**
	 * Gets representation
	 *
	 * HTTP params are the following:
	 *
	 * *  (details) regions : filter value separated by coma (all|structuralGeometries) (optional)
	 * *  (int) id : representation id (optional)
	 * *  (int) peptide_id : peptide id (optional)
	 *
	 *
	 * Returns an array formatted as the following:
	 * <code>
	 * array(
	 * 		'xcount' => int
	 *		'items' => array(
	 *			'id' => int,
	 *			'title' => string,
	 *			'description' => string,
	 *			'params' => array(
	 *				'dimension' => array(
	 *					'minX' => float,
	 *					'maxX' => float,
	 *					'minY' => float,
	 *					'maxY' => float
	 *				),
	 *				'membrane' => array(
	 *					'minY' => float,
	 *					'maxY' => float
	 *				)
	 *			),
	 *			'contributors' : array(
	 *				array('lastName' => string, 'firstName' => string)
	 *			),
	 *			'structuralGeometries' => array (
	 *				array(
	 *					'id' => int,
	 *					'representation_id' => int,
	 *					'type' => 'cercle|line|loop|extendedLoop',
	 *					'pos' => int,
	 *					'params' => array(
	 *						'rotation' => int,
	 *						'sens'=> int
	 *					),
	 *					'labels' => array(
	 *						'string-int'
	 *					),
	 *					'coordinates' => array(
	 *						array(
	 *							'id' => int, 
	 *							'x' => float, 
	 *							'y' => float, 
	 *							'amino_acid_id' => int
	 *						)
	 *					)
	 *			)
	 *		)
	 *		
	 *	}
	 *  </code>
	 * @returns array data (xcount, items[])
	 */
	function get() {
		//checks if action is allowed
		if (!in_array('get', $this->allow)) throw new xException("Method not allowed", 403);

		$data = array();
		
		//if true, all regions will be returned
		//otherwise, only membrane regions
		$detailFilter = array();

		if (isset($this->params['details']))
			$detailFilter = explode(",", $this->params['details']);


		//receives representations from model
		$representations = xModel::load('representation', $this->params)->get();

		$data['xcount'] = count($representations);
		$items = array();

		foreach ($representations as $representation) {
			$item = array();
			$item['id'] = $representation['id'];
			$item['title'] = $representation['title'];
			//decode params as information is stored as json
			$item['params'] = json_decode($representation['params']);

			$structuralGeometries = array();
			//if there is at least one value in filter
			if (count($detailFilter) > 0) {
				if (in_array('all', $detailFilter) || in_array('structuralGeometries', $detailFilter)) {
					//receives structural geometries for current representation
					$r = xController::load(
						'structural-geometries',
						array(
							'representation_id' => $representation['id']
						)
					)->get();
					$structuralGeometries = $r['items'];
				}
			}
			$item['structuralGeometries'] = $structuralGeometries;
			$items[] = $item;
		}
		$data['items'] = $items;
		return $data;
	}
	
	/**
	 * Updates representation
	 * 
	 * HTTP params are the following:
	 *
	 * *  (int) id : representation id (mandatory)
	 * 
	 * For data format, see get method
	 * 
	 * 
	 */
	function post() {
		// Checks if method is allowed
		if (!in_array('post', $this->allow)) throw new xException("Method not allowed", 403);
		// Checks provided parameters
		if (!isset($this->params['items'])) throw new xException('No items provided', 400);
		
		$items = $this->params['items'];
		if (!isset($items['id'])) throw new xException('No id provided', 400);
		
		$ret = array();
		
		$structuralGeometries = $items['structuralGeometries'];
		
		foreach ($structuralGeometries as $structuralGeometry) {
			
			$coordinates = $structuralGeometry['coordinates'];
			
			foreach ($coordinates as $coordinate) {
				$ret = xController::load(
						'structural-coordinates', array(
								'id' => $coordinate['id'],
								'items' => array (
										'id' => $coordinate['id'], 
										'coordinate' => $coordinate['x'] . '/' . $coordinate['y'],
								)
						))->post();
			}
		}
		
		return $ret;
	}

	/**
	 * Creates new representation
	 * @see RESTController::put()
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
		$params = $proteinCalc->getParams();

		$coordPos = 0;
		//db insert
		$representation = xModel::load(
				'representation', array(
						'id' => 0,
						'title' => $title,
						'description' => $description,
						'params' => json_encode($params),
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