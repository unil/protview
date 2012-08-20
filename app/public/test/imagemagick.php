<?php
require_once(dirname(__file__).'/../../lib/protview/xfm/Bootstrap.php');

$b = new Bootstrap();

$svgPath = xContext::$basepath. '/public/test/test.svg';
$pngPath = xContext::$basepath. '/public/test/test.png';

$im = new Imagick();
$svg = file_get_contents($svgPath);


$im->readImageBlob($svg);

/*png settings*/
$im->setImageFormat("png32");
//$im->resizeImage(720, 445, imagick::FILTER_LANCZOS, 1);  /*Optional, if you need to resize*/

/*jpeg*/
//$im->setImageFormat("jpeg");
//$im->adaptiveResizeImage(720, 445); /*Optional, if you need to resize*/


header('Content-type: image/png');

echo $im;

?>