<?php
require_once(dirname(__file__).'/../../xfm/lib/Core/Bootstrap.php');

/**
 * Project specific bootstrap extension.
 * Includes custom protview-specific xfm classes extensions.
 * @package protview
 */
class Bootstrap extends xBootstrap {

    function setup_includes_externals() {
        parent::setup_includes_externals();
        require_once(xContext::$basepath.'/lib/protview/xfm/RESTController.php');
    }
}
