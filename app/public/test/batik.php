<?php
require_once(dirname(__file__).'/../../lib/protview/xfm/Bootstrap.php');

$b = new Bootstrap();

$svgPath = xContext::$basepath. '/public/test/protein.svg';
$pngPath = xContext::$basepath. '/public/test/protein.png';
$batikPath = xContext::$basepath. '/public/test/batik-1.7/batik-rasterizer.jar';

exec("java -jar $batikPath $svgPath");


header('Content-type: image/png');

echo file_get_contents($pngPath);
?>
