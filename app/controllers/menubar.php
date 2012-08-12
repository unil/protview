<?php

class MenubarController extends RESTController {


	function defaultAction() {
		$data = array();
		return xView::load('menubar/newprotein', $data, $this->meta)->render();
	}
	
	function newproteinAction() {
		$data = array();
		return xView::load('menubar/newprotein', $data, $this->meta)->render();
	}
}