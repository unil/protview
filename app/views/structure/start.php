<?php

class StructureStartView extends xView {
    function init() {
        $this->meta = xUtil::array_merge($this->meta, array(
            'js' => array(
            	xUtil::url('a/js/protview/structure/controller/MainController.js'),
            )
        ));
    }
}