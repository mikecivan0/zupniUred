<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}	
	

	if (strlen(trim($_POST["svezak"]))==0) {
		$g=new stdClass();
		$g->element="svezak";
		$g->poruka="Obavezno svezak";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["zaGodinu"]))==0) {
		$g=new stdClass();
		$g->element="zaGodinu";
		$g->poruka="Obavezno godina";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["stranica"]))==0) {
		$g=new stdClass();
		$g->element="stranica";
		$g->poruka="Obavezno stranica";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["broj"]))==0) {
		$g=new stdClass();
		$g->element="broj";
		$g->poruka="Obavezno broj";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["datumKrstenja"]))==0) {
		$g=new stdClass();
		$g->element="datumKrstenja";
		$g->poruka="Obavezno datum krštenja";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["ime"]))==0) {
		$g=new stdClass();
		$g->element="ime";
		$g->poruka="Obavezno ime";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["prezime"]))==0) {
		$g=new stdClass();
		$g->element="prezime";
		$g->poruka="Obavezno prezime";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["datumRodjenja"]))==0) {
		$g=new stdClass();
		$g->element="datumRodjenja";
		$g->poruka="Obavezno datum rođenja";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["mjestoRodjenja"]))==0) {
		$g=new stdClass();
		$g->element="mjestoRodjenja";
		$g->poruka="Obavezno mjesto rođenja";
		array_push($greske,$g);
	}
	
	
	if(empty($greske)&&empty($_POST["hfOsobaId"])){
		$izraz = $veza -> prepare("select * from osobe o inner join maticaKrstenih mk on mk.osoba_id=o.id
								   where o.ime=:ime and o.prezime=:prezime and o.spol=:spol
								   and mk.datumRodjenja=:datumRodjenja and mk.mjestoRodjenja=:mjestoRodjenja and mk.datumKrstenja=:datumKrstenja;");
		$izraz -> bindParam(':ime', $_POST["ime"]);
		$izraz -> bindParam(':prezime', $_POST["prezime"]);
		$izraz -> bindParam(':spol', $_POST["spol"]);
		$izraz -> bindParam(':datumRodjenja', $_POST["datumRodjenja"]);
		$izraz -> bindParam(':mjestoRodjenja', $_POST["mjestoRodjenja"]);
		$izraz -> bindParam(':datumKrstenja', $_POST["datumKrstenja"]);
		$izraz -> execute();
		$osoba = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($osoba)){
			$g=new stdClass();
			$g->element="ime";
			$g->poruka="Osoba već postoji u bazi";
			array_push($greske,$g);
			}
	}