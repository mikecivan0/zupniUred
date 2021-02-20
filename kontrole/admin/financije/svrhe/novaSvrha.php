<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}


	if (trim(strlen($_POST["svrha"]))==0) {
		$g=new stdClass();
		$g->element="svrha";
		$g->poruka="Obavezan naziv svrhe";
		array_push($greske,$g);
	}

	