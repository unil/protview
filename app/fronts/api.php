<?php
/**
 * Manages api calls
 * 
 * Comments added by Stefan Meier
 *
 * @package fronts
 * @author Damien Corpataux
 *
 */
class ApiFront extends xApiFront {

    /**
     * @see xFront::$method_mapping
     */
    var $method_mapping = array(
        'GET' => 'get',
        'POST' => 'get',
        'PUT' => 'post',
        'DELETE' => 'delete'
    );

    function __construct($params = null) {
        parent::__construct($params);
        // Sets the called method according the HTTP Request Verb if no method specified
        if (!@$this->params['xmethod']) $this->params['xmethod'] = @$this->http['method'];
    }

    /**
     * Gets the specified resource
     * 
     * @return String xml|Json string
     */
    function get() {
        $result = $this->call_method();
        print $this->encode($result);
    }

    /**
     * Updates the specified resource
     *
     * @return String xml|Json string
     */
    function post() {
        $result = $this->call_method();
        print $this->encode($result);
    }

    /**
     * Creates the specified resource
     *
     * @return String xml|Json string
     */
    function put() {
        $result = $this->call_method();
        print $this->encode($result);
    }

    /**
     * Deletes the specified resource
     *
     * @return String xml|Json string
     */
    function delete() {
        $result = $this->call_method();
        print $this->encode($result);
    }
}