<?php

class SubunitModel extends xModelMysql {

    public $table = 'subunits';

    public $mapping = array(
        'id' => 'id',
    	'protein_id' => 'protein_id',
		'label' => 'label',
    	'pos' => 'pos'
    );

    public $validation = array(
        'id' => 'mandatory',
        'name' => 'mandatory'
    );
    
    public $joins = array(
    		'protein' => 'LEFT JOIN proteins ON (proteins.id = subunits.protein_id)'
    );
    
    public $join = array('protein');
}