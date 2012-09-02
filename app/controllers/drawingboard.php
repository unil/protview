<?php

class DrawingBoardController extends RESTController {
	function defaultAction() {
		throw new xException("Method not allowed", 403);
	}

	function exportDialogAction() {
		$css = '';

		if (isset($this->params['css']))
			$css = $this->params['css'];

		$data = array('css' => $css);
		return xView::load('drawingboard/export', $data, $this->meta)->render();
	}

	function exportAction() {
		$png = null;

		if (!isset($this->params['svgContent'])) throw new xException('No SVG content provided', 400);
		if (!isset($this->params['token'])) throw new xException('No token for download provided', 400);

		$token = $this->params['token'];
		$svgContent = $this->params['svgContent'];


		if ($svgContent != null) {
			require_once(xContext::$basepath.'/lib/protview/protview/graph/SVGConverter.php');
			$cssFile = xContext::$basepath. '/public/a/css/' . $this->params['css'];;

			$viewbox = null;

			$svg = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin meet" ';
				
			if (isset($this->params['svgViewbox'])) {
				$viewbox = $this->params['svgViewbox'];
				$svg .= 'viewBox="' . $viewbox . '" ';
			}
				
			if (isset($this->params['export-size'])) {
				$size = $this->params['export-size'];

				$width = 0;
				$height = 0;
					
				if ($size == 'other') {
					if (isset($this->params['export-size-other-width']) && is_numeric($this->params['export-size-other-width'])) {
						$width = $this->params['export-size-other-width'];
					}
					if (isset($this->params['export-size-other-height']) && is_numeric($this->params['export-size-other-height'])) {
						$height = $this->params['export-size-other-height'];
					}
				}
				else if ($size == 'original') {
					if ($viewbox != null) {
						$s = explode(' ', $viewbox);
						if (is_numeric($s[2]))
							$width = (int)$s[2];
						if (is_numeric($s[3]))
							$height = (int)$s[3];
					}

					
				}
				else{
					$s = explode('x', $size);
					$width = $s[0];
					$height = $s[1];
				}
					
				if ($width > 0) {
					$svg .= 'width="' . $width . '" ';
				}
					
				if ($height > 0) {
					$svg .= 'height="' . $height . '" ';
				}
				//xContext::$log->log("width: $width height: $height", 'export');
			}
				
			$svg .= '>';

			$style = '<style type="text/css"><![CDATA[';

			if (file_exists($cssFile))
				$style .= file_get_contents($cssFile);

			$style .= ']]></style>';

			$svg .= $style;
			$svg .= $svgContent;
			$svg .= '</svg>';
				
			$png = SVGConverter::SVGStreamToPNG($svg);
		}
		setcookie("download", $token, time()+3600, xUtil::url(''));
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=export.png");
		header("Content-Type: application/octet-stream; ");
		header("Content-Transfer-Encoding: binary");
		print $png ;
	}
}