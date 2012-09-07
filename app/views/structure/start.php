<?php
/** 
* Handles StructureStart View
*
* Defines meta data and options for view
*
* @package views
* @author Stefan Meier
* @version 20120906
*
*/
class StructureStartView extends xView {
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
            	xUtil::url('a/js/protview/structure/controller/MainController.js'),
            	xUtil::url('a/js/protview/structure/model/Protein.js'),
            	xUtil::url('a/js/protview/structure/model/Peptide.js'),
            	xUtil::url('a/js/protview/structure/controller/ProteinController.js'),
            	xUtil::url('a/js/protview/structure/controller/PeptideController.js'),
            	xUtil::url('a/js/protview/structure/view/NewProteinView.js'),
            	xUtil::url('a/js/protview/structure/view/ProteinView.js'),
            	xUtil::url('a/js/protview/structure/view/PeptideView.js'),
            )
        ));
    }
}