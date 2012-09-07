<?php
/**
 * Handles AminoAcid Table actions
 * 
 * Validates data and specifies table joint
 *
 * @package models
 * @author Stefan Meier
 * @version 20120906
 *
 */
class AminoAcidModel extends xModelMysql {

	/**
	 * Table name
	 * @var String
	 */
    public $table = 'amino_acids';

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
    	'region_id' => 'region_id',
    	'type' => 'type',
    	'link' => 'link',
		'modification' => 'modification',
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
    	'region' => 'LEFT JOIN regions ON (regions.id = amino_acids.region_id)'
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
    public $join = array('region');
}