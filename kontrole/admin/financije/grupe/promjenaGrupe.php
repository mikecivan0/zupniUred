<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	
		$izraz = $veza -> prepare("select * from grupe where nazivGrupe=:grupa and id!=:id");
		$izraz -> execute($_POST);
		$grupa = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($grupa)){
			$g=new stdClass();
			$g->element="grupa";
			$g->poruka="Grupa sa tim nazivom već postoji";
			array_push($greske,$g);
			}
