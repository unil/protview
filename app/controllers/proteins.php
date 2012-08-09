<?php

class ProteinsController extends RESTController {

	public $model = 'protein';
	
	function defaultAction() {
		$data = array();
		return xView::load('structure/protein', $data, $this->meta)->render();
	}
}