<?php

class LayoutLayoutView extends xView {

    function init() {
        $this->meta = xUtil::array_merge($this->meta, array(
            'layout' => array(
                'template' => 'layout.tpl',
            ),
            'js' => array(
            	/*
            	 * JQuery Core / template
            	 *  
            	 */
                xUtil::url('a/js/jquery/jquery-1.7.2.min.js'),
            	xUtil::url('a/js/jquery/jquery-ui-1.8.21.custom.min.js'),
             	/*
             	 * JQuery SVG
             	 */
            	xUtil::url('a/js/jquery/jquery.svg.min.js'),
            	xUtil::url('a/js/jquery/jquery.svgdom.min.js'),
            	/*
            	 * JQuery Widgets
            	 * 
            	 *  Dependency:
            	 *  	- core (all plugin)
            	 *  	- window (tabs, docking)
            	 *  	- docking (docking)
            	 */
            	xUtil::url('a/js/jqwidgets/jqxcore.js'),
            	xUtil::url('a/js/jqwidgets/jqxwindow.js'),
            	xUtil::url('a/js/jqwidgets/jqxtabs.js'),
            	xUtil::url('a/js/jqwidgets/jqxmenu.js'),
            	xUtil::url('a/js/jqwidgets/jqxdocking.js'),
            	/*
            	 * ProtView BootStrap js
            	 */
            	xUtil::url('a/js/BootStrap.js'),
            ),
            'css' => array(
                // Custom CSS
                xUtil::url('a/css/template.css'),
            	xUtil::url('a/css/jquery.svg.css'),
            	xUtil::url('a/css/protein.css'),
            	xUtil::url('a/js/jqwidgets/styles/jqx.base.css'),
            	xUtil::url('a/js/jqwidgets/styles/jqx.summer.css')
            )
        ));
    }

    function render() {
        return $this->apply($this->meta['layout']['template']);
    }
}