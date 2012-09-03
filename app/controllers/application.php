<?php
/**
 * Controls the main application part
 *
 * @package controllers
 * @author Stefan Meier
 * @version 20120903
 *
 */
class ApplicationController extends xWebController {

	/**
	 * Returns a 403 exception as defaultAction is not available
	 * 
	 * @returns xException
	 */
	function defaultAction() {
		throw new xException("Method not allowed", 403);
	}
	
	/**
	 * Loads Drawboard View
	 * 
	 * @return \views\drawboard\DrawboardStartView
	 */
	function startDrawboardAction() {
		$data = array();
		return xView::load('drawboard/start', $data, $this->meta)->render();
	}
	
	/**
	 * Loads Sidebar
	 * 
	 * @return \views\sidebar\SidebarStartView
	 */
	function startSidebarAction() {
		$data = array();
		return xView::load('sidebar/start', $data, $this->meta)->render();
	}
	
	/**
	 * Loads structure component
	 * 
	 * @return \views\structure\StructureStartView
	 */
	function startStructureAction() {
		$data = array();
		return xView::load('structure/start', $data, $this->meta)->render();
	}
}