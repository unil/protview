<?php
require_once('AminoAcid.php');
class Region {
	private $id;
	private $name;
	private $type;
	private $start;
	private $end;
	private $peptide;
	
	private $aminoAcids = array();
	
	public function __construct($id, $start, $end, $type = null, $name = null) {
		$this->id = $id;
		$this->start = $start;
		$this->end = $end;
		$this->name = $name;
		$this->type = $type;
	}

	public function getId()
	{
	    return $this->id;
	}

	public function getType()
	{
	    return $this->type;
	}

	public function getStart()
	{
	    return $this->start;
	}

	public function getEnd()
	{
	    return $this->end;
	}

	public function addAminoAcid($aminoAcid) {
		if (!in_array($aminoAcid, $this->aminoAcids)) {
			$this->aminoAcids[] = $aminoAcid;
			$aminoAcid->setRegion($this);
		}
	}
	
	public function getAminoAcids()
	{
	    return $this->aminoAcids;
	}

	public function getName()
	{
	    return $this->name;
	}
	
	public function countAminoAcids() {
		return count($this->aminoAcids);
	}

	public function getPeptide()
	{
	    return $this->peptide;
	}

	public function setPeptide($peptide)
	{
		if ($this->peptide != $peptide) {
	    	$this->peptide = $peptide;
	    	$this->peptide->addRegion($this);
		}
	}
}

?>