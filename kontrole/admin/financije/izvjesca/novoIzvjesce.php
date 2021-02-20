<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}


	if (trim(strlen($_POST["nazivIzvjesca"]))==0) {
		$g=new stdClass();
		$g->element="nazivIzvjesca";
		$g->poruka="Obavezan naziv izvješća";
		array_push($greske,$g);
	}

	
	if(empty($greske)){
		$izraz = $veza -> prepare("select * from izvjesca where nazivIzvjesca=:nazivIzvjesca");
		$izraz -> execute($_POST);
		$izvjesce = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($izvjesce)){
			$g=new stdClass();
			$g->element="nazivIzvjesca";
			$g->poruka="Izvješće sa tim nazivom već postoji";
			array_push($greske,$g);
			}
	}