<?php
class Dokument extends SQL {
	private $title;
	private $user;

	function __construct($ida, $title) {
		$this -> user = $_SESSION[$ida . "autoriziran"] -> userId;
		$this -> title = $title;
	}

	public function parseDoc() {
		parent::__construct();
		if (isset($_GET["docId"])) {
			$this -> get();
		} else {
			if (isset($_POST["hfDocId"])) {
				self::update();
			} else {
				self::insert();
			}

		}
	}

	private function insert() {
		$this -> izraz = $this -> veza -> prepare("insert into dokumenti(zapis,naziv,user_id,putanja) values(:zapis,:naziv,:user_id,:putanja)");
		$this -> izraz -> bindParam(":zapis", $this -> postToGet());
		$this -> izraz -> bindParam(":naziv", 	$this->nazivDokumenta());
		$this -> izraz -> bindParam(":user_id", $this -> user);
		$this -> izraz -> bindParam(":putanja", $_SERVER["PHP_SELF"]);
		$this -> izraz -> execute();
		$_POST["hfDocId"] = $this -> veza -> lastInsertId();
		$_GET["poruka"] = "Dokument je uspješno spremljen";
	}

	private function get() {
		$dokument = $this->provjeriValjanost();
		if(!empty($dokument)){
			$this -> getArrToPosts($dokument -> zapis);
			unset($_POST["hfDocId"]);//mora se napraviti unset da ne remeti uslove za kreiranje polja u html-u
		}else{
			$_GET["poruka"] = "Ne možete pregledavati tuđe dokumente";
		}
		
	}

	private function update() {
		$ima = $this->provjeriValjanost();
		if(!empty($ima)){
			$this -> izraz = $this -> veza -> prepare("update dokumenti set naziv=:naziv,zapis=:zapis where id=:id and user_id=:user_id");
			$this -> izraz -> bindParam(":naziv", $this->nazivDokumenta());
			$this -> izraz -> bindParam(":zapis", $this -> postToGet());
			$this -> izraz -> bindParam(":id", $_POST["hfDocId"]);
			$this -> izraz -> bindParam(":user_id", $this -> user);
			$this -> izraz -> execute();
			$_GET["poruka"] = "Dokument je uspješno spremljen";
		}else{
			$_GET["poruka"] = "Ne možete uređivati tuđe dokumente";
		}		
	}
	
	private function provjeriValjanost() {
		$id = ($_POST) ? $_POST["hfDocId"] : $_GET["docId"];	
		$putanja = "%" . $_SERVER["PHP_SELF"] . "%";//potrebno radi prevencije traženja dokumenta prema id-u a na drugoj putanji
		$this -> izraz = $this -> veza -> prepare("select * from dokumenti where id=:id and user_id=:user_id and putanja like :putanja");
		$this -> izraz -> bindParam(":id", $id);
		$this -> izraz -> bindParam(":user_id", $this -> user);
		$this -> izraz -> bindParam(":putanja", $putanja);
		$this -> izraz -> execute();
		$dokument = $this -> izraz -> fetch(PDO::FETCH_OBJ);
		if(empty($dokument)){
			return false;
		}else{
			return $dokument;
		}		
	}

	public function getArrToPosts($str) {
		parse_str($str, $array);
		foreach ($array as $key => $value) {
			$_POST[$key] = $value;
		}
	}

	public function postToGet() {
		$str = "";
		foreach ($_POST as $key => $value) {
			$str .= $key . "=" . str_replace('&nbsp;', '', $value) . "&";
		}
		$str = substr($str, 0, -1);
		return $str;
	}

	private function nazivDokumenta() {
		switch (true) {
			case ($this->title=='Krsni list' || $this->title=='Smrtni list'):
				$naziv = $_POST["ime"] . " " . $_POST["prezime"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;

			case ($this->title=='Posvjedočenje' || $this->title=='Potvrdnica'):
				$naziv = $_POST["imePrezime"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;

			case ($this->title=='Zapisnik o prijašnjoj ženidbenoj vezi ili izvanbračnoj zajednici'):
				$naziv = $_POST["imeIPrezime"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;

			case ($this->title=='Vjenčani list' || $this->title=='Obavijest o sklopljenoj ženidbi'):
				$naziv = $_POST["imeOn"] . " " . $_POST["prezimeOn"] . " i " . $_POST["imeOna"] . " " . $_POST["prezimeOna"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;

			case ($this->title=='Izvadak iz Knjige primljenih u potpuno zajedništvo Katoličke crkve'):
				$naziv = $_POST["imePrezimeZanimanje"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;

			case ($this->title=='Otpusnica za vjenčanje'):
				$naziv = $_POST["imePrezimeOn"] . " i " . $_POST["imePrezimeOna"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;

			case ($this->title=='Molba za mješovitu ženidbu' || $this->title=='Ženidbeni navještaj u župi prebivališta'):
				$naziv = $_POST["imeIPrezimeOn"] . " i " . $_POST["imeIPrezimeOna"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;

			case ($this->title=='Pristupnica i obavijest o podjeljenoj potvrdi'):
				$naziv = $_POST["potvrdjenik"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;

			case ($this->title=='Izjava roditelja uz ženidbu njihova maloljetnika'):
				$naziv = $_POST["dijete"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;

			case ($this->title=='Dopuštenje za sklapanje ženidbe izvan vlastite župe'):
				$naziv = $_POST["zarucnik"] . " i " . $_POST["zarucnica"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;

			case ($this->title=='Izjave i obećanja prigodom mješovite ženidbe'):
				$naziv = $_POST["imeIPrezime1"] . " i " . $_POST["imeIPrezime2"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;

			case ($this->title=='Molba za oprost od zapreke različitosti vjere'):
				$naziv = $_POST["imeIPrezimeKatolik"] . " i " . $_POST["imeIPrezimeNekatolik"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;
				
			case ($this->title=='Postupak za ženidbu'):
				$naziv = $_POST["prezimena"] . " - " . $this -> title . " " . date("d.m.Y.");
				break;
		}

		return $naziv;
	}

}
