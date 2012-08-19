<?php

class RepresentationModel extends xModelMysql {

    public $table = 'representations';

    public $mapping = array(
        'id' => 'id',
    	'peptide_id' => 'peptide_id',
		'title' => 'title',
    	'description' => 'description',
    	'params' => 'params'
    );

    public $validation = array(
        'id' => 'mandatory',
    	'peptide_id' => 'mandatory'
    );
    
    public $joins = array(
    		'peptide' => 'LEFT JOIN peptides ON (peptides.id = representations.peptide_id)'
    );
    
    public $join = array('peptide');
}