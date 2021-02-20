<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

	
	if (strlen(trim($_POST["nazivMjesta"]))==0) {
		$g=new stdClass();
		$g->element="nazivMjesta";
		$g->poruka="Obavezan naziv mjesta";
		array_push($greske,$g);
	}

	if (strlen(trim($_POST["pbr"]))!=5||!is_numeric($_POST["pbr"])) {
		$g=new stdClass();
		$g->element="pbr";
		$g->poruka="Poštanski broj mora sadržavati 5 brojeva";
		array_push($greske,$g);
	}
	
	
	if(empty($greske)){
		$izraz = $veza -> prepare("select * from mjesta where nazivMjesta=:nazivMjesta and pbr=:pbr");
		$izraz -> execute($_POST);
		$mjesto = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($mjesto)){
			$g=new stdClass();
			$g->element="nazivMjesta";
			$g->poruka="Mjesto sa tim nazivom i poštanskim brojem već postoji";
			array_push($greske,$g);
			}
	}