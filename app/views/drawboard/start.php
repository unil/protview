<?php
/**
 * Handles DrawBoardStart View
 *
 * Defines meta data and options for view
 *
 * @package views
 * @author Stefan Meier
 * @version 20120906
 *
 */
class DrawboardStartView extends xView {
	/**
	 * Defines metadata
	 * 
	 * <code>
	 * array(
	 * 	'js' => array('filePath'),
	 * 	'css' => array('filePath)
	 * )
	 * </code>
	 */
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
            	xUtil::url('a/js/protview/drawboard/model/Representation.js'),
            	xUtil::url('a/js/protview/drawboard/controller/DrawBoardController.js'),
            	xUtil::url('a/js/protview/drawboard/view/DrawBoardView.js'),
            	xUtil::url('a/js/protview/drawboard/view/ToolbarView.js'),
            ),
            'css' => array(
                // SVG template
            	xUtil::url('a/css/jquery.svg.css'),
            	xUtil::url('a/css/protein.css'),
            )
        ));
    }
}