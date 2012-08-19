<?php

class MenubarController extends RESTController {


	function defaultAction() {
		
	}
	
	function newproteinAction() {
		$data = array();
		return xView::load('menubar/newprotein', $data, $this->meta)->render();
	}
}