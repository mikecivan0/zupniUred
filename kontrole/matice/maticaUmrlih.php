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
	
	if (strlen(trim($_POST["datumSmrti"]))==0) {
		$g=new stdClass();
		$g->element="datumSmrti";
		$g->poruka="Obavezno datum smrti";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["mjestoSmrti"]))==0) {
		$g=new stdClass();
		$g->element="mjestoSmrti";
		$g->poruka="Obavezno mjesto smrti";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["datumPokopa"]))==0) {
		$g=new stdClass();
		$g->element="datumPokopa";
		$g->poruka="Obavezno datum pokopa";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["mjestoPokopa"]))==0) {
		$g=new stdClass();
		$g->element="mjestoPokopa";
		$g->poruka="Obavezno mjesto pokopa";
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
	