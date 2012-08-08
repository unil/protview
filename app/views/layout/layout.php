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
            	xUtil::url('a/js/lib/underscore-1.3.3.min.js'),
            	xUtil::url('a/js/lib/backbone-0.9.2.min.js'),
            	xUtil::url('a/js/lib/backbone-relational-0.6.0.js'),
            	xUtil::url('a/js/lib/jquery.ba-tinypubsub.min.js'),
            	xUtil::url('a/js/lib/Class.js'),
            	/*
            	 * Templating
            	* JQuery Widgets
            	*
            	*  Dependency:
            	*  	- core (all plugin)
            	*  	- window (tabs, docking)
            	*  	- docking (docking)
            	*/
            	xUtil::url('a/js/lib/jqwidgets/jqxcore.js'),
            	xUtil::url('a/js/lib/jqwidgets/jqxwindow.js'),
            	xUtil::url('a/js/lib/jqwidgets/jqxtabs.js'),
            	xUtil::url('a/js/lib/jqwidgets/jqxmenu.js'),
            	xUtil::url('a/js/lib/jqwidgets/jqxdocking.js'),
            ),
            'css' => array(
                // Custom CSS
                xUtil::url('a/css/main.css'),
            	xUtil::url('a/css/bootstrap.css'),
            	xUtil::url('a/js/lib/jqwidgets/styles/jqx.base.css'),
            	xUtil::url('a/js/lib/jqwidgets/styles/jqx.summer.css')
            )
        ));
    }

    function render() {
        return $this->apply($this->meta['layout']['template']);
    }
}