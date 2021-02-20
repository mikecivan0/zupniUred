<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	
		$izraz = $veza -> prepare("select * from automatskiUnosi where primSvrha_id=:primSvrha_id 
								  and zupa_id is null;");
		$izraz->bindParam(':primSvrha_id', $_POST["primSvrha_id"]);
		$izraz -> execute();
		$automatika = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($automatika)){
			$porukaGreske = "Ta primarna svrha je već pridružena";
			}
