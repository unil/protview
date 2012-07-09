<?php

class TestRESTController extends RESTController {

    function defaultAction() {
        $data['welcome-text'] = 'Test REST';
        return xView::load('test/rest', $data)->render();
    }
    
    function get() {
    	return $this->params;
    }
    
    function post() {
    	return $this->params;
    }
    
    function delete() {
    	return $this->params;
    }
    
    function put() {
    	return $this->params;
    }
}