<?php
/**
 * Extension class form xWebFront in order to prevent template loading
 *
 * @package controllers
 * @author Stefan Meier
 * @version 20120906
 *
 */
class RawFront extends xWebFront {
	/**
	 * @see xWebFront::get()
	 */
    function get() {
       $controller_name = @$this->params['xcontroller'];
        if (@$this->params['xmodule']) $controller_name = "{$this->params['xmodule']}/$controller_name";
        $controller = xController::load($controller_name, $this->params);

        $data = $controller->call(@$this->params['xaction']);
        print $data;
    }
}