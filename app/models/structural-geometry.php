<?php
/**
 * Handles StructuralGeometry Table actions
 *
 * Validates data and specifies table joint
 *
 * @package models
 * @author Stefan Meier
 * @version 20120906
 *
 */
class StructuralGeometryModel extends xModelMysql {
	/**
	 * Table name
	 * @var String
	 */
    public $table = 'structural_geometries';
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
    	'representation_id' => 'representation_id',
    	'region_id' => 'region_id',
		'params' => 'params',
    	'type' => 'type',
    	'pos' => 'pos'
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
        'representation_id' => 'mandatory',
    	'region_id' => 'mandatory',
    	'type' => 'mandatory',
    	'pos' => 'mandatory',
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
    		'representation' => 'LEFT JOIN representations ON (representations.id = structural_geometries.representation_id)',
    		'region' => 'LEFT JOIN regions ON (regions.id = structural_geometries.region_id)'
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
    		'representation',
    		'region'
    );
}