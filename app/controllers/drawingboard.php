<?php

class DrawingBoardController extends RESTController {
	function defaultAction() {
		$data = array();
		return xView::load('drawingboard/start', $data, $this->meta)->render();
	}
	
	function convertAction() {
		require_once(xContext::$basepath.'/lib/protview/protview/graph/SVGConverter.php');
		
		$png = SVGConverter::toPNG($svgFile);
		
		$data = array('png' => $png);
		return xView::load('drawingboard/export', $data, $this->meta)->render();
	}
}