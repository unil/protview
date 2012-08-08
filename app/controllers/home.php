<?php

class HomeController extends xWebController {

    function defaultAction() {
    	$data = array();
        return xView::load('home/home', $data)->render();
    }
}