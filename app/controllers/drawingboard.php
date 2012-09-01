<?php

class DrawingBoardController extends RESTController {
	function defaultAction() {
		throw new xException("Method not allowed", 403);
	}
	
	function exportDialogAction() {
		$data = array();
		return xView::load('drawingboard/export', $data, $this->meta)->render();
	}

	function exportAction() {
		$png = null;

		$svgContent = $this->params['svg'];

		if ($svgContent != null) {
			require_once(xContext::$basepath.'/lib/protview/protview/graph/SVGConverter.php');
			$cssFile = xContext::$basepath. '/public/a/css/' . $this->params['css'];;


			$svg = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg">';
			$svg = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin meet" style="display:inline; float: left; z-index: 1;" id="svg-representation" height="515px" width="1720px" viewBox="-11 -373.75867942507 1843.1723956808 631.98821614399">';

			$style = '<style type="text/css"><![CDATA[';

			if (file_exists($cssFile))
				$style .= file_get_contents($cssFile);

			$style .= ']]></style>';

			$svg .= $style;
			$svg .= $svgContent;
			$svg .= '</svg>';
			
			


			$png = SVGConverter::SVGStreamToPNG($svg);
		}
		require_once(xContext::$basepath.'/lib/protview/protview/graph/SVGConverter.php');
		$svg = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg"><style type="text/css"><![CDATA[circle{stroke: #006600;fill:#00cc00;}]]></style><circle cx="40" cy="40" r="24"/></svg>';
		$png = SVGConverter::SVGStreamToPNG($svg);

		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=export.png");
		header("Content-Type: application/octet-stream; "); 
		header("Content-Transfer-Encoding: binary");
		print $png ;
	}
}