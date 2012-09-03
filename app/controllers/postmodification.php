<?php
/**
 * Shows the postmodification form
 *
 * @package controllers
 * @author Stefan Meier
 * @version 20120903
 *
 */
class PostmodificationController extends RESTController {
	/**
	 * Gets the default postmodification form
	 *
	 * @return \views\structure\PostModificationView
	 */
	function defaultAction() {
		$data = array();
		return xView::load('structure/postmodification', $data, $this->meta)->render();
	}
}