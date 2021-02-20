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
	
	if (strlen(trim($_POST["email"]))!=0) {
			if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST["email"])){
			    $g=new stdClass();
				$g->element="email";
				$g->poruka="Neispravan format email-a";
				array_push($greske,$g);	
			}
		}
		
	
	