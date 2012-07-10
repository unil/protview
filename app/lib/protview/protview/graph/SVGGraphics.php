<?php

class SVGGraphics {
	
	public function drawAminoAcid($x, $y, $size, $label, $pos) {
		return "<g id=\"aa-{$pos}\" class=\"aa\" transform=\"translate({$x},{$y})\">
		<circle r=\"". ($size/2) . "\"/>
		<text x=\"-4\" y=\"0\">{$label}</text>
		<text class=\"seq_num\" x=\"0\" y=\"6\">{$pos}</text>
		</g>";
	}
	
	public function drawMembrane($x, $y, $width, $height) {
		$membrane = "";
		$membrane .= "<line x1=\"{$x}\" x2=\"". ($x+$width) . "\" y1=\"". ($y-$height/2) . "\" y2=\"". ($y-$height/2) . "\" style=\"fill:none;stroke:#d83200;stroke-width:2px;\"/>";
		$membrane .= "<line x1=\"{$x}\" x2=\"". ($x+$width) . "\" y1=\"{$y}\" y2=\"{$y}\" style=\"fill:none;stroke:#fab998;stroke-width:". ($height) . "px;\"/>";
		$membrane .= "<line x1=\"{$x}\" x2=\"". ($x+$width) . "\" y1=\"". ($y+$height/2) . "\" y2=\"". ($y+$height/2) . "\" style=\"fill:none;stroke:#d83200;stroke-width:1px;\"/>";
		return $membrane;
	}
}

?>