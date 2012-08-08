<?php
class AminoAcid {
	private $id;
	private $type;
	private $variant;
	private $modification;
	private $link;
	private $domain;
	
	public function __construct($id, $type) {
		$this->id = $id;
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

	public function getVariant()
	{
	    return $this->variant;
	}

	public function setVariant($variant)
	{
	    $this->variant = $variant;
	}

	public function getModification()
	{
	    return $this->modification;
	}

	public function setModification($modification)
	{
	    $this->modification = $modification;
	}

	public function getLink()
	{
	    return $this->link;
	}

	public function setLink($link)
	{
	    $this->link = $link;
	}

	public function getDomain()
	{
	    return $this->domain;
	}

	public function setDomain($domain)
	{
		if ($this->domain != $domain) {
	    	$this->domain = $domain;
	    	$this->domain->addAminoAcid($this);
		}
	}
}

?>