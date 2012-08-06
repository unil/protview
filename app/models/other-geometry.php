<?php

class OtherGeometryModel extends xModelMysql {

    public $table = 'other_geometries';

    public $mapping = array(
        'id' => 'id',
    	'representation_id' => 'representation_id',
		'params' => 'params',
    	'coordinates' => 'coordinates'
    );

    public $validation = array(
        'id' => 'mandatory',
        'name' => 'mandatory'
    );
    
    public $joins = array(
    		'representation' => 'LEFT JOIN representations ON (representations.id = other_geometries.representation_id)'
    );
    
    public $join = array('representation');
}