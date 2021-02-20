<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}


	if (trim(strlen($_POST["nazivGrupe"]))==0) {
		$g=new stdClass();
		$g->element="nazivGrupe";
		$g->poruka="Obavezan naziv grupe";
		array_push($greske,$g);
	}

	
	if(empty($greske)){
		$izraz = $veza -> prepare("select * from grupe where nazivGrupe=:nazivGrupe");
		$izraz -> execute($_POST);
		$grupa = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($grupa)){
			$g=new stdClass();
			$g->element="nazivGrupe";
			$g->poruka="Grupa sa tim nazivom već postoji";
			array_push($greske,$g);
			}
	}