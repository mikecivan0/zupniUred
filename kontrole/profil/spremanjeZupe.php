<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}	
	

	if (strlen(trim($_POST["nazivZupe"]))==0) {
		$g=new stdClass();
		$g->element="nazivZupe";
		$g->poruka="Obavezno naziv župe";
		array_push($greske,$g);
	}
	
	if(empty($greske)){
		$izraz = $veza -> prepare("select * from zupe where nazivZupe=:nazivZupe and mjesto_id=:hfMjestoId and id!=:id;");
		$izraz -> bindParam(':nazivZupe', $_POST["nazivZupe"]);
		$izraz -> bindParam(':hfMjestoId', $_POST["hfMjestoId"]);
		$izraz -> bindParam(':id', $_GET["id"]);
		$izraz -> execute();
		$zupa = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($zupa)){
			$g=new stdClass();
			$g->element="nazivZupe";
			$g->poruka="Župa već postoji";
			array_push($greske,$g);
			}
	}