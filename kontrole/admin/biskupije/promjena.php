<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}


	
		$izraz = $veza -> prepare("select * from biskupije where nazivBiskupije=:biskupija");
		$izraz -> bindParam(':biskupija',$_POST["biskupija"]);
		$izraz -> execute($_POST);
		$biskupija = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($biskupija)){
			$g=new stdClass();
			$g->element="nazivBiskupije";
			$g->poruka="Biskupija sa tim nazivom već postoji";
			array_push($greske,$g);
			}
