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

	//find domain with highest amount of aa, not in all domains
	
	public function countAminoAcids($filter = null) {
		$count = 0;
		

		
		foreach ($this->domains as $d) {
			if ($filter == 'trans')
				if ($d->getType() == 'trans') {
					$count += $d->countAminoAcids();
					xContext::$log->log("count: {$count}", 'protein');
			}
			else 
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