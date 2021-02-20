<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

	
	if (strlen(trim($_POST["nazivPrintera"]))==0) {
		$g=new stdClass();
		$g->element="nazivPrintera";
		$g->poruka="Obavezan naziv printera";
		array_push($greske,$g);
	}

	
	if(empty($greske)){
		$izraz = $veza -> prepare("select * from printeri where nazivPrintera=:nazivPrintera");
		$izraz -> execute($_POST);
		$printer = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($printer)){
			$g=new stdClass();
			$g->element="nazivPrintera";
			$g->poruka="Printer sa tim nazivom već postoji";
			array_push($greske,$g);
			}
	}