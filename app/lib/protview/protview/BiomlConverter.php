<?php

class BiomlConverter {
	public static function PhpToBioML($prot) {
		$bioml = array();
		
		if ($prot instanceof Protein) {
			$rawSeq = null;
			if ($prot->getNote() != null)
				$bioml["note"] = $prot->getNote();

			if ($prot->getSpecies() != null)
				$bioml["organism"]["species"] = $prot->getSpecies();
			if ($prot->getName() != null)
				$bioml["protein"]["name"] = $prot->getName();
			
			$subunits = $prot->getSubunits();
			
			foreach($subunits as $s) {
				$tS = array();

				foreach ($s->getPeptides() as $p) {
					$tpP = array();
					$tPLabel = "peptide id=\"{$p->getId()}\" start=\"{$p->getStart()}\" end=\"{$p->getEnd()}\"";
					
					if ($p->getId() == null)
					
					$rawSeq = "";
					$rawSeqOffset = 10;
					foreach($p->getDomains() as $d) {
						$tD = array();	
						$tD["name"] = $d->getName();
						$tDLabel = "domain id=\"{$d->getId()}\" type=\"{$d->getType()}\" start=\"{$d->getStart()}\" end=\"{$d->getEnd()}\"";
						
						foreach($d->getAminoAcids() as $aa) {
							$tAA = array();
							$rawSeq .= $aa->getType();

							if($aa->getVariant() != null || $aa->getModification() != null || $aa->getLink() != null) {
								$tpAALabel = "aa type=\"{$aa->getType()}\" at=\"{$aa->getId()}\"";
								if($aa->getVariant() != null)
									$tD[$tpAALabel]["avariant at=\"{$aa->getId()}\" type=\"{$aa->getVariant()}\""] = "";
								if($aa->getModification() != null)
									$tD[$tpAALabel]["amod at=\"{$aa->getId()}\" type=\"{$aa->getType()}\" occ=\"{$aa->getModification()}\""] = "";
								if($aa->getLink() != null)
									$tD[$tpAALabel]["alink at=\"{$aa->getId()}\" type=\"{$aa->getType()}\" to=\"S[{$s->getId()}]P[{$p->getId()}]A[{$aa->getLink()}]\""] = "";
							}
						}
						
						$tP[$tDLabel] = $tD;
					}
					$tS[$tPLabel] = $tP; 
					$tS[$tPLabel]["sequence"] = $rawSeq;
				}
				
				$bioml["protein"]["subunit id=\"{$s->getId()}\" label=\"{$s->getName()}\""] = $tS;
			}
		}
		
		return $bioml;
	}
	
	public static function BioMLToPhp ($bioml) {
		
	}
	/*
	 * 
	 * 	{
	    "struct": {
	        "ref": "https: //protview/bioml-asdf.bioml",
	        "protein": "name",
	        "link": "//covalentmodification",
	        "subunit": [
	        	{"id": 1,"comp": [1,2,3]},
	            {"id": 2,"comp": [2,1,5]}
	        ],
	        "peptide": [
	        	{"id": 1,"comp": [1,2],"seq": ["A","B","C"],"mod": {"ubiquity": [1,2,3], "sugar": [4,5,6]}}
	        ],
	        "domain": [
	        	{"id": 1,"type": "intra","start": 1,"end": 128},
	        	{"id": 2,"type": "extra","start": "129","end": 135}
	        ]
	    },
	    "graph": {
	        "coords": {
	            "aa": [
	                {"x": 12.1,"y": 13.3,"ref": {"subunit": 1,"peptide": 4,"seq": 45}}
	            ]
	        },
	        "template": "unil-dpt"
	    }
	}
	*/
	public static function BioMLToJSON($prot) {
		$protview = array();
		
		if ($prot instanceof Protein) {
			$rawSeq = null;
			if ($prot->getNote() != null)
				$protview["protein"]["note"] = $prot->getNote();
		
			if ($prot->getSpecies() != null)
				$protview["protein"]["species"] = $prot->getSpecies();
			if ($prot->getName() != null)
				$protview["protein"]["name"] = $prot->getName();
				
			$subunits = $prot->getSubunits();
				
			foreach($subunits as $s) {
				$subunit = array();
				$subunit['id'] = $s->getId();
				$subunit['label'] = $s->getName();

				foreach ($s->getPeptides() as $p) {
					$peptide = array();
					$peptide['id'] = $p->getId();
					$peptide['start'] = $p->getStart();
					$peptide['end'] = $p->getEnd();
						
					if ($p->getId() == null)
						$rawSeq = "";
					$rawSeqOffset = 10;
					foreach($p->getDomains() as $d) {
						$domain = array();
						$domain["name"] = $d->getName();
						$domain['id'] = $d->getId();
						$domain['type'] = $d->getType();
						$domain['start'] = $d->getStart();
						$domain['end'] = $d->getEnd();
		
						foreach($d->getAminoAcids() as $aa) {
							$rawSeq .= $aa->getType();
		
							if($aa->getVariant() != null || $aa->getModification() != null || $aa->getLink() != null) {
								if($aa->getVariant() != null)
									$peptide['variant'][$aa->getVariant()][] = $aa->getId();
								if($aa->getModification() != null)
									$peptide['modification'][$aa->getModification()][] = $aa->getId();
								/*if($aa->getLink() != null)
									$peptide['modification'][$aa->getModification()][] = $aa->getId();
									$tD[$tpAALabel]["alink at=\"{$aa->getId()}\" type=\"{$aa->getType()}\" to=\"S[{$s->getId()}]P[{$p->getId()}]A[{$aa->getLink()}]\""] = "";*/
							}
						}
						$protview['domain'][] = $domain;
					}
					$peptide["seq"] = $rawSeq;
					$protview['peptide'][] = $peptide;
				}

				$protview['subunit'][] = $subunit;
			}
		}
		
		return $protview;
	}
}

?>