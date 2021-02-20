<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	
		$izraz = $veza -> prepare("select * from izvjesca where nazivIzvjesca=:izvjesce and id!=:id");
		$izraz -> execute($_POST);
		$izvjesce= $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($izvjesce)){
			$g=new stdClass();
			$g->element="izvjesce";
			$g->poruka="Izvješće sa tim nazivom već postoji";
			array_push($greske,$g);
			}
