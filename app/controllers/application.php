<?php

class ApplicationController extends xWebController {

	function defaultAction() {
		throw new xException("Method not allowed", 403);
	}
	
	function startDrawboardAction() {
		$data = array();
		return xView::load('drawingboard/start', $data, $this->meta)->render();
	}
	
	function startSidebarAction() {
		$data = array();
		return xView::load('sidebar/start', $data, $this->meta)->render();
	}
}