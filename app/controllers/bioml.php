<?php

require_once(xContext::$basepath.'/lib/protview/protview/bio/Protein.php');
require_once(xContext::$basepath.'/lib/protview/protview/BiomlConverter.php');

class BIOMLController extends RESTController {  
	
    function get() {
    	
		$bioml = null;
    	
		$sequence = "MGKGVGRDKYEPAAVSEQGDKKGKKGKKDRDMDELKKEVSMDDHKLSLDELHRKYGTDLSRGLTSARAAEILARDGPNALTPPPTTPEWIKFCRQLFGGFSMLLWIGAILCFLAYSIQAATEEEPQNDNLYLGVVLSAVVIITGCFSYYQEAKSSKIMESFKNMVPQQALVIRNGEKMSINAEEVVVGDLVEVKGGDRIPADLRIISANGCKVDNSSLTGESEPQTRSPDFTNENPLETRNIAFFSTNCVEGTARGIVVYTGDRTVMGRIATLASGLEGGQTPIAAEIEHFIHIITGVAVFLGVSFFILSLILEYTWLEAVIFLIGIIVANVPEGLLATVTVCLTLTAKRMARKNCLVKNLEAVETLGSTSTICSDKTGTLTQNRMTVAHMWFDNQIHEADTTENQSGVSFDKTSATWLALSRIAGLCNRAVFQANQENLPILKRAVAGDASESALLKCIELCCGSVKEMRERYAKIVEIPFNSTNKYQLSIHKNPNTSEPQHLLVMKGAPERILDRCSSILLHGKEQPLDEELKDAFQNAYLELGGLGERVLGFCHLFLPDEQFPEGFQFDTDDVNFPIDNLCFVGLISMIDPPRAAVPDAVGKCRSAGIKVIMVTGDHPITAKAIAKGVGIISEGNETVEDIAARLNIPVSQVNPRDAKACVVHGSDLKDMTSEQLDDILKYHTEIVFARTSPQQKLIIVEGCQRQGAIVAVTGDGVNDSPALKKADIGVAMGIAGSDVSKQAADMILLDDNFASIVTGVEEGRLIFDNLKKSIAYTLTSNIPEITPFLIFIIANIPLPLGTVTILCIDLGTDMVPAISLAYEQAESDIMKRQPRNPKTDKLVNERLISMAYGQIGMIQALGGFFTYFVILAENGFLPIHLLGLRVDWDDRWINDVEDSYGQQWTYEQRKIVEFTCHTAFFVSIVVVQWADLVICKTRRNSVFQQGMKNKILIFGLFEETALAAFLSYCPGMGVALRMYPLKPTWWFCAFPYSLLIFVYDEVRKLIIRRRPGGWVEKETYY";
		
		$protein = new Protein("ATPase", "Homo sapiens");
		$protein->setNote("The following is a valid BIOML file describing of sodium/potassium-transporting ATPase subunit alpha-1 isoform a");
		
		$subunit = new Subunit(1);
		$subunit->setName("alpha-1 isoform a");

		$peptide = new Peptide(1, 1, 110);
		$domain = new Domain(1, 1, 2, "Domain A", "signal");
		$count = 1;
		foreach(str_split($sequence) as $element) {
			$domain->addAminoAcid(new AminoAcid($count, $element));
			$count++;
		}
		$aa = new AminoAcid($count, "A");
		$aa->setVariant("B");
		$domain->addAminoAcid($aa);
		
		$aa = new AminoAcid($count+1, "B");
		$aa->setVariant("C");
		$aa->setModification("phosporylation");
		$domain->addAminoAcid($aa);
		
		$aa = new AminoAcid($count+2, "D");
		$aa->setLink(96);
		$domain->addAminoAcid($aa);
		
		$peptide->addDomain($domain);
		$peptide->addDomain(new Domain(2, 1, 2, "Domain A", "signal"));
		$peptide->addDomain(new Domain(3, 1, 2, "Domain B", "signal"));
		$subunit->addPeptide($peptide);
		
		$protein->addSubunit($subunit);

    	$bioml = BiomlConverter::PhpToBioML($protein);
    	
    	return array("bioml" => $bioml);
    	

    }
}