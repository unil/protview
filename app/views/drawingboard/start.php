<?php

class DrawingboardStartView extends xView {
    function init() {
        $this->meta = xUtil::array_merge($this->meta, array(
            'js' => array(
            	/*
            	 * JQuery SVG
            	 */
            	xUtil::url('a/js/lib/jquery.svg.min.js'),
            	xUtil::url('a/js/lib/jquery.svgdom.min.js'),
            	/*
            	 * ProtView
            	 */	
            	xUtil::url('a/js/protview/drawboard/controller/MainController.js'),
            	xUtil::url('a/js/protview/drawboard/utils/Drawing.js'),
            	xUtil::url('a/js/protview/drawboard/model/StructuralGeometry.js'),
            	xUtil::url('a/js/protview/drawboard/model/StructuralGeometryCollection.js'),
            	xUtil::url('a/js/protview/drawboard/controller/DrawBoardController.js'),
            	xUtil::url('a/js/protview/drawboard/view/DrawBoardView.js'),
            ),
            'css' => array(
                // SVG template
            	xUtil::url('a/css/jquery.svg.css'),
            	xUtil::url('a/css/protein.css'),
            )
        ));
    }
}