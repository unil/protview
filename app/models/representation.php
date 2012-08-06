<?php

class RepresentationModel extends xModelMysql {

    public $table = 'representations';

    public $mapping = array(
        'id' => 'id',
		'name' => 'name'
    );

    public $validation = array(
        'id' => 'mandatory',
        'name' => 'mandatory'
    );
}