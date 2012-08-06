<?php

class AminoAcidModel extends xModelMysql {

    public $table = 'amino_acids';

    public $mapping = array(
        'id' => 'id',
    	'region_id' => 'region_id',
    	'type' => 'type',
    	'link' => 'link',
		'modification' => 'modification',
    	'pos' => 'pos'
    );

    public $validation = array(
        'id' => 'mandatory',
        'name' => 'mandatory'
    );
    
    public $joins = array(
    	'region' => 'LEFT JOIN regions ON (regions.id = amino_acids.region_id)'
    );
    
    public $join = array('region');
}