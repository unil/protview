<?php
/**
 * Controls the DrawBoard application part
 *
 * @package controllers
 * @author Stefan Meier
 * @version 20120903
 *
 */
class DrawBoardController extends RESTController {
	/**
	 * Returns a 403 exception as defaultAction is not available
	 * 
	 * @returns xException
	 */
	function defaultAction() {
		throw new xException("Method not allowed", 403);
	}

	/**
	 * Gets the representation export dialog
	 *
	 * HTTP params are the following:
	 *
	 * *  (string) css : name of css file (optional)
	 *
	 * @return \views\drawboard\DrawBoardExportView
	 */
	function exportDialogAction() {
		$css = '';

		if (isset($this->params['css']))
			$css = $this->params['css'];

		$data = array('css' => $css);
		return xView::load('drawboard/export', $data, $this->meta)->render();
	}

	/**
	 * Converts a SVG Dom-Element to PNG file
	 * 
	 * HTTP params are the following:
	 * 
	 * *  (string) svgContent : SVG Dom-elemet (mandatory)
	 * *  (string) token : download token (mandatory)
	 *
	 * @throws xException
	 * @return string (application/octet-stream)
	 */
	function exportAction() {
		$png = null;

		if (!isset($this->params['svgContent'])) throw new xException('No SVG content provided', 400);
		if (!isset($this->params['token'])) throw new xException('No token for download provided', 400);

		$token = $this->params['token'];
		$svgContent = $this->params['svgContent'];


		if ($svgContent != null) {
			require_once(xContext::$basepath.'/lib/protview/protview/graph/SVGConverter.php');
				

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
				/*for original size, width and height is equal to viewbox width and height
				 * 
				 *minx : the beginning x coordinate
				 *miny :the beginning y coordinate
				 *width :width of the view box
				 *height :height of the view box
				 *
				 *viewbox format : [minx miny width height]
				*/
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
					//export size format : width x height (without spaces)
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
			}

			$svg .= '>';

			if (isset($this->params['css'])) {
				$style = '<style type="text/css"><![CDATA[';

				$cssFile = xContext::$basepath. '/public/a/css/' . $this->params['css'];
				if (file_exists($cssFile))
					$style .= file_get_contents($cssFile);

				$style .= ']]></style>';
			}

			$svg .= $style;
			$svg .= $svgContent;
			$svg .= '</svg>';

			$png = SVGConverter::SVGStreamToPNG($svg);
		}
		//set download cokie with specified token value
		setcookie("download", $token, time()+3600, xUtil::url(''));
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=export.png");
		header("Content-Type: application/octet-stream; ");
		header("Content-Transfer-Encoding: binary");
		print $png ;
	}
}