<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}	
	if (strlen(trim($_POST["nazivZupe"]))==0) {
		$g=new stdClass();
		$g->element="nazivZupe";
		$g->poruka="Obavezan naziv župe";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["mjesto"]))==0) {
		$g=new stdClass();
		$g->element="mjesto";
		$g->poruka="Odaberite mjesto";
		array_push($greske,$g);
	}elseif(strlen(trim($_POST["hfMjestoId"]))==0){
		$g=new stdClass();
		$g->element="mjesto";
		$g->poruka="Nepostojeće mjesto";
		array_push($greske,$g);
	}

	if (strlen(trim($_POST["biskupija"]))==0) {
		$g=new stdClass();
		$g->element="biskupija";
		$g->poruka="Odaberite biskupiju";
		array_push($greske,$g);
	}elseif(strlen(trim($_POST["hfBiskupijaId"]))==0){
		$g=new stdClass();
		$g->element="biskupija";
		$g->poruka="Nepostojeća biskupija";
		array_push($greske,$g);
	}
	
	if(empty($greske)){
		$izraz = $veza -> prepare("select * from zupe where nazivZupe=:nazivZupe and mjesto_id=:mjesto_id");
		$izraz -> bindParam(":nazivZupe", $_POST["nazivZupe"]);
		$izraz -> bindParam(":mjesto_id", $_POST["hfMjestoId"]);
		$izraz -> execute();
		$mjesto = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($mjesto)){
			$g=new stdClass();
			$g->element="nazivZupe";
			$g->poruka="Župa sa tim nazivom i u tom mjestu već postoji";
			array_push($greske,$g);
			}
	}