<?php

class StructuralGeometryModel extends xModelMysql {

    public $table = 'structural_geometries';

    public $mapping = array(
        'id' => 'id',
    	'representation_id' => 'representation_id',
    	'region_id' => 'region_id',
		'params' => 'params',
    	'type' => 'type',
    	'pos' => 'pos'
    );

    public $validation = array(
        'id' => 'mandatory',
        'representation_id' => 'mandatory',
    	'region_id' => 'mandatory',
    	'type' => 'mandatory',
    	'pos' => 'mandatory',
    );
    
    public $joins = array(
    		'representation' => 'LEFT JOIN representations ON (representations.id = structural_geometries.representation_id)',
    		'region' => 'LEFT JOIN regions ON (regions.id = structural_geometries.region_id)'
    );
    
    public $join = array(
    		'representation',
    		'region'
    );
}