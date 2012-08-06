<?php

class StructuralCoordinateModel extends xModelMysql {

    public $table = 'structural_coordinates';

    public $mapping = array(
        'id' => 'id',
    	'structural_geometry_id' => 'structural_geometry_id',
    	'amino_acid_id' => 'amino_acid_id',
		'coordinate' => 'coordinate'
    );

    public $validation = array(
        'id' => 'mandatory',
        'name' => 'mandatory'
    );
    
    public $joins = array(
    		'structural_geometry' => 'LEFT JOIN structural_geometries ON (structural_geometries.id = structural_coordinates.structural_geometry_id)',
    		'amino_acid' => 'LEFT JOIN amino_acids ON (amino_acids.id = structural_coordinates.amino_acid_id)'
    );
    
    public $join = array(
    		'structural_geometry',
    		'amino_acid'
    );
}