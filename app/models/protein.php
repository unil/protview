<?php

class ProteinModel extends xModelMysql {

    public $table = 'proteins';

    public $mapping = array(
        'id' => 'id',
		'name' => 'name',
    	'species' => 'species',
    	'note' => 'note'
    );

    public $validation = array(
        'id' => 'mandatory',
        'name' => 'mandatory'
    );
}