<?php

class WebFront extends xWebFront {
    function get() {
       $controller_name = @$this->params['xcontroller'];
        if (@$this->params['xmodule']) $controller_name = "{$this->params['xmodule']}/$controller_name";
        $controller = xController::load($controller_name, $this->params);

        $data = $controller->call(@$this->params['xaction']);
        print $data;
    }
}