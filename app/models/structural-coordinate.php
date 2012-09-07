<?php
/**
 * Handles StructuralCoordinate Table actions
 *
 * Validates data and specifies table joint
 *
 * @package models
 * @author Stefan Meier
 * @version 20120906
 *
 */
class StructuralCoordinateModel extends xModelMysql {
	/**
	 * Table name
	 * @var String
	 */
    public $table = 'structural_coordinates';
    /**
     * Table mapping
     *
     * <code>
     * array(
     * 	'columnName' => 'arrayKeyName'
     * )
     * </code>
     *
     * @var array
     */
    public $mapping = array(
        'id' => 'id',
    	'structural_geometry_id' => 'structural_geometry_id',
    	'amino_acid_id' => 'amino_acid_id',
		'coordinate' => 'coordinate'
    );
    /**
     * Data validation
     *
     * <code>
     * array(
     * 	'columnName' => 'mandatory'
     * )
     * </code>
     *
     * @var array
     */
    public $validation = array(
        'id' => 'mandatory',
        'amino_acid_id' => 'mandatory',
    	'structural_geometry_id' => 'mandatory',
    	'coordinate' => 'mandatory'
    );
    /**
     * Defines possible table joins
     *
     * <code>
     * array(
     * 	'tableName' => 'LEFT JOIN tableName ON (tableName.id = thisTable.foreignKey)
     * )
     * </code>
     *
     * @var array
     */
    public $joins = array(
    		'structural-geometry' => 'LEFT JOIN structural_geometries ON (structural_geometries.id = structural_coordinates.structural_geometry_id)',
    		'amino-acid' => 'LEFT JOIN amino_acids ON (amino_acids.id = structural_coordinates.amino_acid_id)'
    );
    /**
     * Indicates which join should by activated by default
     *
     * <code>
     * array(
     * 	'tableName',
     * 	'table2Name'
     * )
     * </code>
     *
     * @var array
     */
    public $join = array(
    		'structural-geometry',
    		'amino-acid'
    );
}