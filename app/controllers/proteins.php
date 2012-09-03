<?php
/**
 * Manages the acid protein model
 *
 * @package controllers
 * @author Stefan Meier
 * @version 20120903
 *
 */
class ProteinsController extends RESTController {
	
	/**
	 *
	 * @var \models\ProteindModel
	 */
	public $model = 'protein';
	
	/**
	 * Gets the default postmodification form
	 *
	 * @return \views\structure\ProteinView
	 */
	function defaultAction() {
		$data = array();
		return xView::load('structure/protein', $data, $this->meta)->render();
	}
	
	function put() {
		$r = parent::put();
		//inserts a subunit with same id as protein, as for now there is only
		//one subunit per protein and one peptide per subunit
		if ($r['insertid']) {
		$s = xModel::load('subunit', 
				array(
				'id' => $r['insertid'],
				'label' => $this->params['items']['name'],
				'protein_id' => $r['insertid'],
				'pos' => 1)
				)->put();
		}
		if ($s['insertid']) {
			$p = xModel::load('peptide',
					array(
							'id' => $s['insertid'],
							'label' => $this->params['items']['name'],
							'subunit_id' => $s['insertid'],
							'pos' => 1)
			)->put();
		}
		// Result
		return $r;
	}
}