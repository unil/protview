<?php

class PostmodificationController extends RESTController {
	function defaultAction() {
		$data = array();
		return xView::load('structure/postmodification', $data, $this->meta)->render();
	}
	function get() {
		$ret = array();
		return $ret;
	}
}