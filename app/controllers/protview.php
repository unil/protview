<?php

require_once(xContext::$basepath.'/lib/protview/protview/ProtView.php');


class ProtViewController extends RESTController {  
	
    function get() {	
		$protView = new ProtView();
    	return $protView->dummy();
    }
}