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
		$izraz = $veza -> prepare("select * from svrhe where zupa_id=:zupa_id and nazivSvrhe=:svrha and grupa_id=:grupa_id and id!=:id;");
		$izraz -> bindParam(':id', $_GET["id"]);
		$izraz -> bindParam(':zupa_id', $_GET["zupa_id"]);
		$izraz -> bindParam(':grupa_id', $_POST["grupa_id"]);
		$izraz -> bindParam(':svrha', $_POST["svrha"]);
		$izraz -> execute();
		$svrha = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($svrha)){
			$g=new stdClass();
			$g->element="svrha";
			$g->poruka="Svrha sa tim nazivom i u toj grupi već postoji";
			array_push($greske,$g);
			}
	}