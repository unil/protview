<?php

class StructureController extends RESTController {
	function defaultAction() {
		$data = array();
		return xView::load('structure/structure', $data, $this->meta)->render();
	}
}