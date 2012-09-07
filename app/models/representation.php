<?php
/**
 * Handles Representation Table actions
 *
 * Validates data and specifies table joint
 *
 * @package models
 * @author Stefan Meier
 * @version 20120906
 *
 */
class RepresentationModel extends xModelMysql {
	/**
	 * Table name
	 * @var String
	 */
    public $table = 'representations';
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
    	'peptide_id' => 'peptide_id',
		'title' => 'title',
    	'description' => 'description',
    	'params' => 'params'
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
    	'peptide_id' => 'mandatory'
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
    		'peptide' => 'LEFT JOIN peptides ON (peptides.id = representations.peptide_id)'
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
    public $join = array('peptide');
}