<?php

class SidebarController extends RESTController {
	function defaultAction() {
		$data = array();
		return xView::load('sidebar/start', $data, $this->meta)->render();
	}
	function get() {
		$ret = array();
		return $ret;
	}
}