<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
		$izraz = $veza -> prepare("select * from kalkulacije where svrha_id=:svrha_id and stavka_id=:stavka_id 
								   and id!=:id and zupa_id=:zupa_id;");
		$izraz -> bindParam(':svrha_id', $_POST["svrha_id"]);
		$izraz -> bindParam(':stavka_id', $_POST["stavka_id"]);
		$izraz -> bindParam(':id', $_POST["id"]);
		$izraz -> bindParam(':zupa_id', $_POST["zupa_id"]);
		$izraz -> execute();
		$kalkulacija = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($kalkulacija)){
			$porukaGreske = "Kalkulacija postoji";
			}
