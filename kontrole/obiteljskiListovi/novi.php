<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}	
	

	if (strlen(trim($_POST["prezime"]))==0) {
		$g=new stdClass();
		$g->element="prezime";
		$g->poruka="Obavezno prezime";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["adresa"]))==0) {
		$g=new stdClass();
		$g->element="adresa";
		$g->poruka="Obavezno adresa";
		array_push($greske,$g);
	}
	