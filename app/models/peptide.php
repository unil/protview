<?php

class PeptideModel extends xModelMysql {

    public $table = 'peptides';

    public $mapping = array(
        'id' => 'id',
    	'subunit_id' => 'subunit_id',
		'label' => 'label',
    	'pos' => 'pos'
    );

    public $validation = array(
        'id' => 'mandatory',
        'name' => 'mandatory'
    );
    
    public $joins = array(
    		'subunit' => 'LEFT JOIN subunits ON (subunits.id = peptides.subunits_id)'
    );
    
    public $join = array('subunit');
}