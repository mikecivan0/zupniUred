<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
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
	
	if (strlen(trim($_POST["mjesto"]))==0) {
		$g=new stdClass();
		$g->element="mjesto";
		$g->poruka="Obavezno mjesto prebivanja";
		array_push($greske,$g);	
	}
	