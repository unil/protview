<?php
/**
 * Menubar controller
 *
 * @package controllers
 * @author Stefan Meier
 * @version 20120903
 *
 */
class MenubarController extends RESTController {
	/**
	 * Returns a 403 exception as defaultAction is not available
	 *
	 * @returns xException
	 */
	function defaultAction() {
		throw new xException("Method not allowed", 403);
	}

	/**
	 * Gets the 'New protein' dialog
	 * 
	 * @return \views\menubar\NewproteinView
	 */
	function newproteinAction() {
		$data = array();
		return xView::load('menubar/newprotein', $data, $this->meta)->render();
	}

	/**
	 * Gets the 'open Representation' dialog
	 * 
	 * Retrieves the list of all representations from database
	 * and sends this information as param to the view
	 *
	 * @return \views\menubar\OpenrepresentationView
	 */
	function openrepresentationAction() {
		$representations = array();
			
		$r =  xModel::load(
				'representation',
				array(
					'xorder' => 'id',
				)
		)->get();

		foreach($r as $representation) {
			$peptide =  xModel::load(
					'peptide',
					array(
							'xjoin' => '',
							'xorder' => 'id',
							'id' => $representation['peptide_id']
					)
			)->get(0);

			$subunit = xModel::load(
					'subunit',
					array(
							'xjoin' => '',
							'xorder' => 'id',
							'id' => $peptide['subunit_id']
					)
			)->get(0);
			$representation['protein_id'] = $subunit['protein_id'];
			$representations[] = $representation;
		}
		$data = array();

		$data['representations'] = $representations;
		return xView::load('menubar/openrepresentation', $data, $this->meta)->render();
	}
}