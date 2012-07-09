<?php

require_once(xContext::$basepath.'/lib/protview/protview/calc/CoordinatesCalculator.php');

class SVGConverter {
	public static function SVGFromPHP($protein) {
		$svg = "";
		
		$svg .= '<?xml version="1.0"?>';
		$svg .= '<?xml-stylesheet href="../a/css/protein.css" type="text/css" title="Default CSS" media="screen" charset="utf-8"?>';
		$svg .= '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
		"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
		<svg xmlns="http://www.w3.org/2000/svg"
		xmlns:xlink="http://www.w3.org/1999/xlink"
		width="100%" height="100%" xml:lang="fr">';
		
		if ($protein instanceof Protein) {
			

		}
		
		
		
		return $svg;
	}
	
	public static function SVGToPNG($svg) {
		//$usmap = '/path/to/blank/us-map.svg';
		$im = new Imagick();
		//$svgin = file_get_contents($svg);
		
		/*loop to color each state as needed, something like
		 1)explode $svgin
		2)foreach($array as $state){preg_replace blank color->state color }
		3)implode to $svgout*/
		
		$im->readImageBlob($svg);
		
		/*png settings*/
		$im->setImageFormat("png24");
		$im->resizeImage(720, 445, imagick::FILTER_LANCZOS, 1);  /*Optional, if you need to resize*/
		
		/*jpeg*/
		//$im->setImageFormat("jpeg");
		//$im->adaptiveResizeImage(720, 445); /*Optional, if you need to resize*/
		
		//$im->writeImage('/path/to/colored/us-map.png');/*(or .jpg)*/

		$img = base64_encode($im);
		$im->clear();
		$im->destroy();
		return $img;
	}
}

?>