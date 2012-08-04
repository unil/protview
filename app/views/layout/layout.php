<?php

class LayoutLayoutView extends xView {

    function init() {
        $this->meta = xUtil::array_merge($this->meta, array(
            'layout' => array(
                'template' => 'layout.tpl',
            ),
            'js' => array(
            	/*
            	 * Libraries
            	 * 
            	 * Basic
            	 */
                xUtil::url('a/js/lib/jquery-1.7.2.min.js'),
            	xUtil::url('a/js/lib/jquery-ui-1.8.21.custom.min.js'),
            	xUtil::url('a/js/lib/jquery.svg.min.js'),
            	xUtil::url('a/js/lib/jquery.svgdom.min.js'),
            	xUtil::url('a/js/lib/underscore-1.3.3.min.js'),
            	xUtil::url('a/js/lib/backbone-0.9.2.min.js'),
            	/*
            	 * ProtView
            	 */	
            	xUtil::url('a/js/protview/ProtView.js'),
            ),
            'css' => array(
                // Custom CSS
                xUtil::url('a/css/main.css'),
            	xUtil::url('a/css/jquery.svg.css'),
            	xUtil::url('a/css/protein.css'),
            	xUtil::url('a/css/bootstrap.css'),
            )
        ));
    }

    function render() {
        return $this->apply($this->meta['layout']['template']);
    }
}