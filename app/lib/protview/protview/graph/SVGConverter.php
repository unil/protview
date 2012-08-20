<?php

class SVGConverter {
	
	public static function SVGStreamToPNG($svgStream) {
		$fileName = microtime() . rand(0, 10) . '.tmp';
		$file = fopen($fileName, 'w+');
		file_put_contents($file, $svgStream);
		
		$png = SVGConverter::toPNG($file);
		exec("rm $fileName");
		return $png;
	}
	
	public static function toPNG($svgFile) {
		$output = null;
		if (file_exists($svgFile)) {
			$batikPath = xContext::$basepath. 'lib/protview/batik-1.7/batik-rasterizer.jar';
			$pngFile = substr($svgFile, -3) + 'png'; 
			
			//create temporary png file on fs
			exec("java -jar $batikPath $svgFile");
			if (file_exists($pngFile)) {
				$output = file_get_contents($pngFile);
				//temp file cleaning
				exec("rm $pngFile");
			}
		}
		
		return $output;
	}
}
?>
