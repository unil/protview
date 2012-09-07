<?php
/**
 * Handles Protein Table actions
 *
 * Validates data and specifies table joint
 *
 * @package models
 * @author Stefan Meier
 * @version 20120906
 *
 */
class ProteinModel extends xModelMysql {
	/**
	 * Table name
	 * @var String
	 */
    public $table = 'proteins';
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
		'name' => 'name',
    	'species' => 'species',
    	'note' => 'note'
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
}