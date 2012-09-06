<?php
/**
 * Manages the StructuralGeometries model
 *
 * @package controllers
 * @author Stefan Meier
 * @version 20120906
 *
 */
class StructuralGeometriesController extends RESTController {
	/**
	 *
	 * @var \models\StructuralGeometryModel
	 */
	public $model = 'structural-geometry';
	/**
	 * @see RESTController::get()
	 */
	function get() {
		if (!in_array('get', $this->allow)) throw new xException("Method not allowed", 403);
		
		$data = array();
		
		$structuralGeometries = array();
		
		$id = null;
		$representation_id = null;

		
		$filter = array(
						'xjoin' => 'region',
						'xreturn' => array(
								'id',
								'region_id',
								'representation_id',
								'pos',
								'params',
								'structural_geometries.type'
						));

		if (isset($this->params['id']))
			$filter['id'] = $this->params['id'];
		
		if (isset($this->params['representation_id']))
			$filter['representation_id'] = $this->params['representation_id'];
		
		$geometries = xModel::load(
				'structural-geometry',
					$filter
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
		$data['xcount'] = count($structuralGeometries);
		$data['items'] = $structuralGeometries;
		return $data;
	}
}