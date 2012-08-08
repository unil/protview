<?php

class SettingsController extends RESTController {
	
	function defaultAction() {
		$data = array(
				'title' => 'Gestion des commissions',
				'id' => 'commissions',
				'model' => 'Commission'
		);
		return xView::load('settings/structural/protein2', $data, $this->meta)->render();
	}
	
	function generalAction() {
		$data = array(
				'title' => 'Gestion des commissions',
				'id' => 'commissions',
				'model' => 'Commission'
		);
		return xView::load('settings/structural/protein', $data, $this->meta)->render();
	}
}