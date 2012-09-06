<?php
require_once('Subunit.php');
/**
 * Protein class
 *
 * @package protview\bio
 * @author Stefan Meier
 * @version 20120906
 *
 */
class Protein {
	private $id;
	private $name;
	private $species;
	private $note;
	private $subunits = array();
	
	public function __construct($name, $species, $note = null) {
		$this->name = $name;
		$this->species = $species;
		$this->note = $note;
	}
	public function getName()
	{
	    return $this->name;
	}

	public function getSpecies()
	{
	    return $this->species;
	}

	public function getNote()
	{
	    return $this->note;
	}

	public function setNote($note)
	{
	    $this->note = $note;
	}

	public function addSubunit($subunit) {
		if (!in_array($subunit, $this->subunits)) {
			$this->subunits[] = $subunit;
			$subunit->setProtein($this);
		}
	}
	
	public function getSubunits()
	{
	    return $this->subunits;
	}
}

?>