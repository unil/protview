<?php

class DrawingBoardController extends RESTController {
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
}