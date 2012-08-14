<?php

class StructureStartView extends xView {
    function init() {
        $this->meta = xUtil::array_merge($this->meta, array(
            'js' => array(
            	xUtil::url('a/js/protview/structure/controller/MainController.js'),
            	xUtil::url('a/js/protview/structure/model/Protein.js'),
            	xUtil::url('a/js/protview/structure/model/Structure.js'),
            	//xUtil::url('a/js/protview/structure/model/ProteinCollection.js'),
            	xUtil::url('a/js/protview/structure/controller/ProteinController.js'),
            	xUtil::url('a/js/protview/structure/controller/StructureController.js'),
            	xUtil::url('a/js/protview/structure/view/ProteinView.js'),
            	xUtil::url('a/js/protview/structure/view/StructureView.js'),
            )
        ));
    }
}