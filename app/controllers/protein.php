<?php

class ProteinController extends RESTController {
	function defaultAction() {
		$data = array();
		return xView::load('structure/protein', $data, $this->meta)->render();
	}
	function get() {
		$ret = array();
		return $ret;
	}
}