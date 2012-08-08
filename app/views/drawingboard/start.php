<?php

class DrawingboardStartView extends xView {

    function init() {
        $this->meta = xUtil::array_merge($this->meta, array(
            'js' => array(
            	/*
            	 * Libraries
            	 * 
            	 * Basic
            	 */

            	xUtil::url('a/js/lib/jquery.svg.min.js'),
            	xUtil::url('a/js/lib/jquery.svgdom.min.js'),
            	/*
            	 * ProtView
            	 */	
            	xUtil::url('a/js/protview/ProtView.js'),
            	xUtil::url('a/js/protview/utils/BackboneMediator.js'),
            	xUtil::url('a/js/protview/utils/Drawing.js'),
            	xUtil::url('a/js/protview/model/StructuralGeometry.js'),
            	xUtil::url('a/js/protview/model/StructuralGeometryCollection.js'),
            	xUtil::url('a/js/protview/controller/DrawBoardController.js'),
            	xUtil::url('a/js/protview/view/DrawBoardView.js'),
            	xUtil::url('a/js/protview/Bootstrap.js'),
            ),
            'css' => array(
                // Custom CSS
            	xUtil::url('a/css/jquery.svg.css'),
            	xUtil::url('a/css/protein.css'),
            )
        ));
    }
}