<?php

class MenubarController extends RESTController {
	function defaultAction() {

	}

	function newproteinAction() {
		$data = array();
		return xView::load('menubar/newprotein', $data, $this->meta)->render();
	}

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