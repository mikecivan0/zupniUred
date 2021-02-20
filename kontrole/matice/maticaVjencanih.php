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
	
	if (strlen(trim($_POST["datumVjencanja"]))==0) {
		$g=new stdClass();
		$g->element="datumVjencanja";
		$g->poruka="Obavezno datum vjenčanja";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["imeOn"]))==0) {
		$g=new stdClass();
		$g->element="imeOn";
		$g->poruka="Obavezno ime";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["imeOna"]))==0) {
		$g=new stdClass();
		$g->element="imeOna";
		$g->poruka="Obavezno ime";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["prezimeOn"]))==0) {
		$g=new stdClass();
		$g->element="prezimeOn";
		$g->poruka="Obavezno prezime";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["prezimeOna"]))==0) {
		$g=new stdClass();
		$g->element="prezimeOna";
		$g->poruka="Obavezno prezime";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["datumRodjenjaOn"]))==0) {
		$g=new stdClass();
		$g->element="datumRodjenjaOn";
		$g->poruka="Obavezno datum rođenja";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["datumRodjenjaOna"]))==0) {
		$g=new stdClass();
		$g->element="datumRodjenjaOna";
		$g->poruka="Obavezno datum rođenja";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["mjestoRodjenjaOn"]))==0) {
		$g=new stdClass();
		$g->element="mjestoRodjenjaOn";
		$g->poruka="Obavezno mjesto rođenja";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["mjestoRodjenjaOna"]))==0) {
		$g=new stdClass();
		$g->element="mjestoRodjenjaOna";
		$g->poruka="Obavezno mjesto rođenja";
		array_push($greske,$g);
	}
	