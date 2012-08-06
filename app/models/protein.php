<?php

class ProteinModel extends xModelMysql {

    public $table = 'proteins';

    public $mapping = array(
        'protein_id' => 'id',
		'protein_name' => 'name',
    	'protein_species' => 'species',
    	'protein_note' => 'note'
    );

    public $validation = array(
        'id' => 'mandatory',
        'name' => 'mandatory'
    );
}