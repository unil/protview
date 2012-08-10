<?php

class StructureStructureView extends xView {
    function init() {
        $this->meta = xUtil::array_merge($this->meta, array(
            'js' => array(
            	/*xUtil::url('a/js/protview/structure/model/Protein.js'),
            	xUtil::url('a/js/protview/structure/model/ProteinCollection.js'),
            	xUtil::url('a/js/protview/structure/controller/ProteinController.js'),
            	xUtil::url('a/js/protview/structure/view/ProteinView.js'),*/
            )
        ));
    }
}