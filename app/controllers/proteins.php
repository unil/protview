<?php

class ProteinsController extends RESTController {

	public $model = 'protein';
	
	function defaultAction() {
		$data = array();
		return xView::load('structure/protein', $data, $this->meta)->render();
	}
	
	function put() {
		$r = parent::put();
		//inserts a subunit with same id as protein, as for now there is only
		//one subunit per protein
		if ($r['insertid']) {
		xModel::load('subunit', 
				array(
				'id' => $r['insertid'],
				'label' => $this->params['items']['name'],
				'protein_id' => $r['insertid'])
				)->put();
		}
		// Result
		return $r;
	}
}