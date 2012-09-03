<?php
/**
 * Home controller (callend on application startup)
 *
 * @package controllers
 * @author Stefan Meier
 * @version 20120903
 *
 */
class HomeController extends xWebController {

	/**
	 * Gets the home page
	 * 
	 * @return \views\home\HomeHomeView
	 */
    function defaultAction() {
    	$data = array();
        return xView::load('home/home', $data)->render();
    }
}