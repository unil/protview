<?php
require_once(xContext::$basepath.'/lib/protview/protview/bio/Protein.php');
require_once(xContext::$basepath.'/lib/protview/protview/BiomlConverter.php');
require_once(xContext::$basepath.'/lib/protview/protview/calc/ProteinCalc.php');

class ProtView {


	private function dummyProtein() {

		/*Create protein test*/
		$sequence = "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";
		$sequence .= "MNTSAPPAVSPNITVLAPGKGPWQVAFIGHITGSLSLATVTGALLVLISFKVNTELKTVNNYFLLSKKSLSKEIGTTSMNNYTTYLLMGHWALGTLACD";

		$domains = array(
				array('start' => 1, 'end' => 24, 'type' => 'extra'),
				array('start' => 25, 'end' => 46, 'type' => 'trans'),
				array('start' => 47, 'end' => 60, 'type' => 'intra'),
				array('start' => 61, 'end' => 80, 'type' => 'trans'),
				array('start' => 81, 'end' => 120, 'type' => 'extra'),
				array('start' => 121, 'end' => 150, 'type' => 'trans'),
				array('start' => 151, 'end' => 300, 'type' => 'intra'),
				array('start' => 301, 'end' => 318, 'type' => 'trans'),
				array('start' => 319, 'end' => 340, 'type' => 'extra'),
				array('start' => 341, 'end' => 360, 'type' => 'trans'),
				array('start' => 361, 'end' => 380, 'type' => 'intra'),
				array('start' => 381, 'end' => 410, 'type' => 'trans'),
				array('start' => 411, 'end' => 431, 'type' => 'extra'),
				array('start' => 432, 'end' => 450, 'type' => 'trans'),
				array('start' => 451, 'end' => 480, 'type' => 'intra')
		);

		//Create protein
		$protein = new Protein("Random protein", "Homo sapiens");
		$protein->setNote("The following is a valid extended BIOML file");

		//Create subunit
		$subunit = new Subunit(1);
		$subunit->setName("alpha-1 isoform a");

		//Create peptide
		$peptide = new Peptide(1, 1, 110);

		//Initialize amino acid counter (id)
		$count = 1;
		//Reade sequence and create amino acid class for each value
		//increases id by one for each amino acid
		//adds amino acids to a domain

		$elements = str_split($sequence);

		for ($d = 0; $d < count($domains); $d++) {
			$dom = $domains[$d];

			$start = $dom['start'];
			$end = $dom['end'];
			$type = $dom['type'];

			$domain = new Domain($d+1, $start, $end, $type);

			for ($s = $start; $s <= $end; $s++) {
				$domain->addAminoAcid(new AminoAcid($s, $elements[$s]));
				$count++;
			}
			$peptide->addDomain($domain);

		}

		$subunit->addPeptide($peptide);
		$protein->addSubunit($subunit);


		return $protein;
	}

	private function dummyCalc($protein) {
		$size = 18;
			
		$startCoord = array("x" => 0, "y" => 0);

		$proteinCalc = new ProteinCalc($protein, $startCoord, $size);

		$coords = $proteinCalc->getAACoordinates();
		return $coords;
	}
	/*
	 * 	    "graph": {
	"coords": {
	"aa": [
	{"x": 12.1,"y": 13.3,"ref": {"subunit": 1,"peptide": 4,"seq": 45}}
	]
	},
	"template": "unil-dpt"
	}
	*/
	private function protViewArray($protein) {
		$coords = $this->dummyCalc($protein);

		$ret = array();

		$struct = array();

		$struct = BiomlConverter::BioMLToJSON($protein);


		$ret['struct'] = $struct;

		$coords = $this->dummyCalc($protein);

		foreach ($coords as $k => $v) {
			$aa = array();
			$aa['x'] = $v["x"] + 80;
			$aa['y'] = $v["y"] + 358;
			$aa['ref']['subunit'] = 1;
			$aa['ref']['peptide'] = 1;
			$aa['ref']['seq'] = $k+1;
			$ret['graph']['coords']['aa'][] = $aa;
		}

		return $ret;
	}

	public function dummy() {
		$protein = $this->dummyProtein();
		return $this->protViewArray($protein);

	}
}

?>