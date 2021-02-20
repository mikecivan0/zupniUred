<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}


	if (trim(strlen($_POST["nazivBiskupije"]))==0) {
		$g=new stdClass();
		$g->element="nazivBiskupije";
		$g->poruka="Obavezan naziv biskupije";
		array_push($greske,$g);
	}

	
	if(empty($greske)){
		$izraz = $veza -> prepare("select * from biskupije where nazivBiskupije=:nazivBiskupije");
		$izraz -> execute($_POST);
		$biskupija = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($biskupija)){
			$g=new stdClass();
			$g->element="nazivBiskupije";
			$g->poruka="Biskupija sa tim nazivom već postoji";
			array_push($greske,$g);
			}
	}