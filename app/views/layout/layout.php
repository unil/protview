<?php
/**
 * Defines Layout View params
 *
 *
 * @package views
 * @author Stefan Meier
 * @version 20120906
 *
 */
class LayoutLayoutView extends xView {
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
            	xUtil::url('a/js/lib/jquery.blockUI.js'),
            	xUtil::url('a/js/lib/jquery.cookie.js'),
            	xUtil::url('a/js/lib/underscore-1.3.3.min.js'),
            	xUtil::url('a/js/lib/backbone-0.9.2.min.js'),
            	xUtil::url('a/js/lib/backbone-relational-0.6.0.js'),
            	xUtil::url('a/js/lib/backbone-modelbinding-0.1.5.min.js'),
            	xUtil::url('a/js/lib/backbone-validation-0.6.2.min.js'),
            	xUtil::url('a/js/lib/jquery.ba-tinypubsub.min.js'),
            	xUtil::url('a/js/lib/Class.js'),
            	xUtil::url('a/js/lib/bootstrap.min.js'),
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
            		
            	xUtil::url('a/js/protview/ProtView.js'),
            	xUtil::url('a/js/protview/lib/BackboneExtension.js'),
            	xUtil::url('a/js/protview/core/BackboneHelper.js'),
            	xUtil::url('a/js/protview/core/MainController.js'),
            	xUtil::url('a/js/protview/core/Controller.js'),
            	xUtil::url('a/js/protview/core/View.js'),
            	xUtil::url('a/js/protview/DrawBoard.js'),
            	xUtil::url('a/js/protview/Structure.js'),
            	xUtil::url('a/js/protview/application/Router.js'),
            	xUtil::url('a/js/protview/application/Mediator.js'),
            	xUtil::url('a/js/protview/application/Context.js'),
            	xUtil::url('a/js/protview/application/Sandbox.js'),
            	xUtil::url('a/js/protview/application/MenubarView.js'),
            	
            ),
            'css' => array(
                // Custom CSS
                xUtil::url('a/css/main.css'),
            	xUtil::url('a/css/bootstrap.css'),
            	xUtil::url('a/js/lib/jqwidgets/styles/jqx.base.css'),
            	xUtil::url('a/js/lib/jqwidgets/styles/jqx.ui-smoothness.css')
            )
        ));
    }

    function render() {
        return $this->apply($this->meta['layout']['template']);
    }
}