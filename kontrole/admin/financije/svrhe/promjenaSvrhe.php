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

	if(empty($greske)){
		$izraz = $veza -> prepare("select s.id as svrhaId,s.nazivSvrhe,g.nazivGrupe from svrhe s inner join grupe g on s.grupa_id=g.id
								   where s.nazivSvrhe=:svrha and s.grupa_id=:grupa_id and s.id!=:id limit 1");
		$izraz -> execute($_POST);
		$svrha = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($svrha)){
			$g=new stdClass();
			$g->element="svrha";
			$g->poruka="Svrha sa tim nazivom i u toj grupi već postoji";
			array_push($greske,$g);
			}
	}