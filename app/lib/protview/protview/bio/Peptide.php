<?php
require_once('Region.php');

class Peptide {
	private $id;
	private $start;
	private $end;
	private $regions = array();
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
	
	public function addRegion($region) {
		if (!in_array($region, $this->regions)) {
			$this->regions[] = $region;
			$region->setPeptide($this);
		}
	}

	public function getRegions()
	{
	    return $this->regions;
	}

	public function getSubunit()
	{
	    return $this->subunit;
	}
	
	

	//find domain with highest amount of aa, not in all domains
	
	public function countAminoAcids($filter = null) {
		$count = array('no_filter' => 0);
	
		foreach ($this->regions as $d) {
			if ($filter != null) {
				if ($d->getType() == $filter) {
					@$count[$filter] += $d->countAminoAcids();
				}
			}
			else {
				$count['no_filter'] += $d->countAminoAcids();
			}
		}
		
		if ($filter != null)
			return @$count[$filter];
		else {

			return $count['no_filter'];

		}
	}
	
	public function countBiggestMembrane() {
		$count = 0;
		
		foreach ($this->regions as $d) {
			if ($d->getType() == 'trans') {
				if ($count < $d->countAminoAcids())
					$count = $d->countAminoAcids();
			}
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