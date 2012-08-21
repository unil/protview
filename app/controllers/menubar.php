<?php

class MenubarController extends RESTController {


	function defaultAction() {
		
	}
	
	function newproteinAction() {
		$data = array();
		return xView::load('menubar/newprotein', $data, $this->meta)->render();
	}
	
	function openrepresentationAction() {
		$representations =  xController::load(
				'representations',
				array(
						'xorder' => 'id',
				)
		)->get();
		$data = array();
		$data['representations'] = $representations['items'];
		return xView::load('menubar/openrepresentation', $data, $this->meta)->render();
	}
}