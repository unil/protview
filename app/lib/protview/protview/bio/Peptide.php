<?php
require_once('Domain.php');

class Peptide {
	private $id;
	private $start;
	private $end;
	private $domains = array();
	private $subunit;
	private $countAminoAcid = 0;
	
	public function __construct($id, $start, $end) {
		$this->id = $id;
		$this->start = $start;
		$this->end = $end;
	}
	
	public function getId()
	{
	    return $this->id;
	}

	public function getStart()
	{
	    return $this->start;
	}

	public function getEnd()
	{
	    return $this->end;
	}
	
	public function addDomain($domain) {
		if (!in_array($domain, $this->domains)) {
			$this->domains[] = $domain;
			$domain->setPeptide($this);
		}
	}

	public function getDomains()
	{
	    return $this->domains;
	}

	public function getSubunit()
	{
	    return $this->subunit;
	}

	
	public function countAminoAcids() {
		$count = 0;
		
		foreach ($this->domains as $d) {
			$count += $d->countAminoAcids();
		}
		return $count;
	}

	public function setSubunit($subunit)
	{
		if ($this->subunit != $subunit) {
	    	$this->subunit = $subunit;
	    	$this->subunit->addPeptide($this);
		}
	}
}
?>