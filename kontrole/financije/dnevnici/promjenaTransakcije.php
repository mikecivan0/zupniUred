<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}	
	
	
	if (strlen(trim($_POST["iznos"]))==0) {
		$g=new stdClass();
		$g->element="iznos";
		$g->poruka="Obavezno iznos";
		array_push($greske,$g);
	}
	