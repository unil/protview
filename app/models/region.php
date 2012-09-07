<?php
/**
 * Handles Region Table actions
 *
 * Validates data and specifies table joint
 *
 * @package models
 * @author Stefan Meier
 * @version 20120906
 *
 */
class RegionModel extends xModelMysql {
	/**
	 * Table name
	 * @var String
	 */
    public $table = 'regions';
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
		'label' => 'label',
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
    	'type' => 'mandatory',
    	'pos' => 'mandatory'
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
    		'peptide' => 'LEFT JOIN peptides ON (peptides.id = regions.peptide_id)'
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