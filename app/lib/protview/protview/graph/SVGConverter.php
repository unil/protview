<?php

class SVGConverter {
	
	
	public static function SVGStreamToPNG($svgStream) {
		$basedir = xContext::$basepath. '/public/tmp';
		$fileName = $basedir . '/'. microtime(true) . rand(0, 10) . '.tmp';
		file_put_contents($fileName, $svgStream);
		
		$png = SVGConverter::toPNG($fileName);
		exec("rm $fileName");
		return $png;
	}
	
	public static function toPNG($svgFile) {
		$output = null;
		
		if (file_exists($svgFile)) {
			$batikPath = xContext::$basepath. '/lib/protview/batik-1.7/batik-rasterizer.jar';
			$pngFile = substr($svgFile, 0, -3) . 'png'; 
			
			//create temporary png file on fs
			exec("java -jar $batikPath $svgFile");
			
			if (file_exists($pngFile)) {	
				$output = file_get_contents($pngFile);
				//tmp file cleaning
				//exec("rm $pngFile");
			}
		}
		
		return $output;
	}
}
?>
