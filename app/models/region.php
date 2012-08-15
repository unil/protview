<?php

class RegionModel extends xModelMysql {

    public $table = 'regions';

    public $mapping = array(
        'id' => 'id',
    	'peptide_id' => 'peptide_id',
		'label' => 'label',
   		'type' => 'type',
    	'pos' => 'pos'
    );

    public $validation = array(
        'id' => 'mandatory',
    	'type' => 'mandatory',
    	'pos' => 'mandatory'
    );
    
    public $joins = array(
    		'peptide' => 'LEFT JOIN peptides ON (peptides.id = regions.peptide_id)'
    );
    
    public $join = array('peptide');
}