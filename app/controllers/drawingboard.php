<?php

class DrawingBoardController extends RESTController {
	function defaultAction() {
		throw new xException("Method not allowed", 403);
	}

	function exportAction() {
		$png = null;

		$svgContent = $this->params['svg'];

		if ($svgContent != null) {
			require_once(xContext::$basepath.'/lib/protview/protview/graph/SVGConverter.php');
			$cssFile = xContext::$basepath. '/public/a/css/' . $this->params['css'];;


			$svg = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg">';

			$style = '<style type="text/css"><![CDATA[';

			if (file_exists($cssFile))
				$style .= file_get_contents($cssFile);

			$style .= ']]></style>';

			$svg .= $style;
			$svg .= $svgContent;
			$svg .= '</svg>';


			$png = SVGConverter::SVGStreamToPNG($svg);
		}
		$data = array('png' => $png);

		return xView::load('drawingboard/export', $data, $this->meta)->render();
	}
}