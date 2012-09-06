<?php
require_once('Peptide.php');
/**
 * Subunit class
 *
 * @package protview\bio
 * @author Stefan Meier
 * @version 20120906
 *
 */
class Subunit {
	private $id;
	private $name;
	private $peptides = array();
	private $protein;
	
	public function __construct($id) {
		$this->id = $id;
	}
	
	public function getId()
	{
	    return $this->id;
	}

	public function setId($id)
	{
	    $this->id = $id;
	}
	
	public function addPeptide($peptide) {
		if (!in_array($peptide, $this->peptides)) {
			$this->peptides[] = $peptide;
			$peptide->setSubunit($this);
		}
	}

	public function getPeptides()
	{
	    return $this->peptides;
	}

	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}

	public function getProtein()
	{
	    return $this->protein;
	}

	public function setProtein($protein)
	{
		if ($this->protein != $protein) {
	    	$this->protein = $protein;
	    	$this->protein->addSubunit($this);
		}
	}
}

?>
