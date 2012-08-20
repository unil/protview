<?php
/**
 * Tests SVGConverter class
 * @package unittests
 */
class SVGConverterTest extends protviewPHPUnit_Framework_TestCase {

	function test_SVGStreamToPNG() {
		require_once(xContext::$basepath.'/lib/protview/protview/graph/SVGConverter.php');
		
		$svgStream = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg"><style type="text/css"><![CDATA[circle{stroke: #006600;fill:#00cc00;}]]></style><circle cx="40" cy="40" r="24"/></svg>';
		
		$png = SVGConverter::SVGStreamToPNG($svgStream);
		
		$this->assertEquals($png, !null);
	}
}
?>