<?php

require_once(__dir__.'/../../../app/lib/xfm/unittests/lib/PHPUnit_Framework_TestCase.php');

/**
 * Custom PHPUnit_Framework_TestCase.
 * Sets up custom authentication information with 'local-superuser' role.
 * @package unittests
 */

class protviewPHPUnit_Framework_TestCase extends xPHPUnit_Framework_TestCase
{

    function setup_bootstrap() {
        require_once(__dir__.'/../../../app/lib/protview/xfm/Bootstrap.php');
        new Bootstrap();
    }

    function setUp() {
        parent::setUp();
    }

    function tearDown() {}

    function create($controller_name, $data) {
        return xController::load($controller_name, array(
            'items' => $data
        ));
    }
    function get($controller_name, $data) {
        $data = is_array($data) ? $data : array('id'=>$data);
        return xController::load($controller_name, $data)->get();
    }

    function dump() {
        print "\n";
        foreach(func_get_args() as $arg) {
            var_dump($arg);
            print "\n";
        }
    }
}

?>
