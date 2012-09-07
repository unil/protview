<?php
/**
 * Handles OtherGeometry Table actions
 *
 * Validates data and specifies table joint
 *
 * @package models
 * @author Stefan Meier
 * @version 20120906
 *
 */
class OtherGeometryModel extends xModelMysql {
	/**
	 * Table name
	 * @var String
	 */
    public $table = 'other_geometries';
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
		'params' => 'params',
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
        'name' => 'mandatory'
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
    		'representation' => 'LEFT JOIN representations ON (representations.id = other_geometries.representation_id)'
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
    public $join = array('representation');
}