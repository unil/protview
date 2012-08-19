<?php

class DrawingBoardController extends RESTController {
	function defaultAction() {
		$data = array();
		return xView::load('drawingboard/start', $data, $this->meta)->render();
	}
}