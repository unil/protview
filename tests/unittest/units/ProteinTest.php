<?php
/**
 * Tests Bioml class.
 * Test are made at xModel level.
 * @package unittests
 */
class BiomlTest extends protviewPHPUnit_Framework_TestCase {

	
	function test_getter_and_setter_protein_classes() {
		require_once(xContext::$basepath.'/lib/protview/protview/Protein.php');
		$sequence = "MGKGVGRDKYEPAAVSEQGDKKGKKGKKDRDMDELKKEV";
		
		//Create protein
		$prot = new Protein("Random protein", "Homo sapiens");
		$prot->setNote("The following is a valid extended BIOML file");
		
		//Create subunit
		$s = new Subunit(1);
		$s->setName("alpha-1 isoform a");

		//Create peptide
		$p = new Peptide(1, 1, 110);
		
		//Create three domains
		$d1 = new Domain(1, 1, 50, "Domain A", "signal");
		$d2 = new Domain(2, 50, 100, "Domain B", "alpha-helix");
		$d3 = new Domain(2, 50, 110, "Domain C", "mature");
		
		//Initialize amino acid counter (id)
		$count = 1;
		//Reade sequence and create amino acid class for each value
		//increases id by one for each amino acid
		//adds amino acids to a domain
		foreach(str_split($sequence) as $element) {
			if ($count % 7 == 0)
				$d1->addAminoAcid(new AminoAcid($count, $element));
			else if ($count % 3 == 0) 
				$d2->addAminoAcid(new AminoAcid($count, $element));
			else 
				$d3->addAminoAcid(new AminoAcid($count, $element));
			$count++;
		}
		$aa = new AminoAcid($count, "A");
		$aa->setVariant("B");
		$d1->addAminoAcid($aa);
		
		$count++;
		$aa = new AminoAcid($count, "B");
		$aa->setVariant("C");
		$aa->setModification("phosporylation");
		
		$p->addDomain($d1);
		$p->addDomain($d2);
		$p->addDomain($d3);
		
		$s->addPeptide($p);
		$prot->addSubunit($s);
		
		//$this->assertCount(count($d1->getPeptide()), 1);
		
		
		var_dump($prot);
	}
}
?>