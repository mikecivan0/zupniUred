<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	
		$izraz = $veza -> prepare("select * from kalkulacije where svrha_id=:svrha_id and stavka_id=:stavka_id 
								  and zupa_id is null;");
		$izraz -> execute($_POST);
		$kalkulacija = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($kalkulacija)){
			$porukaGreske = "Kalkulacija postoji";
			}
