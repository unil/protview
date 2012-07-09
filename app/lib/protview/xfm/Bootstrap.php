<?php
require_once(dirname(__file__).'/../../xfm/lib/Core/Bootstrap.php');

/**
 * Project specific bootsrap extension.
 * Includes custom iafbm-specific xfreemwork classes extensions.
 * @package iafbm
 */
class Bootstrap extends xBootstrap {

    function setup_includes_externals() {
        parent::setup_includes_externals();
        require_once(xContext::$basepath.'/lib/protview/xfm/RESTController.php');
    }
}
