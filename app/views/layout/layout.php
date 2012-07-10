<?php

class LayoutLayoutView extends xView {

    function init() {
        $this->meta = xUtil::array_merge($this->meta, array(
            'layout' => array(
                'template' => 'layout.tpl',
            ),
            'js' => array(
                xUtil::url('a/js/jquery/jquery-1.7.2.min.js'),
            	xUtil::url('a/js/jquery/jquery-ui-1.8.21.custom.min.js'),
            	xUtil::url('a/js/jquery/jquery.svg.min.js'),
            	xUtil::url('a/js/jquery/jquery.svgdom.min.js'),
            	xUtil::url('a/js/BootStrap.js'),
            	/*xUtil::url('a/js/protview/Global.js'),
            	xUtil::url('a/js/protview/Graphic.js')*/
            ),
            'css' => array(
                // Custom CSS
                xUtil::url('a/css/main.css'),
            	xUtil::url('a/css/jquery.svg.css'),
            	xUtil::url('a/css/protein.css')
            )
        ));
    }

    function render() {
        return $this->apply($this->meta['layout']['template']);
    }
}