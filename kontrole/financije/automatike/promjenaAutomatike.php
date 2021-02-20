<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
		$izraz = $veza -> prepare("select * from automatskiUnosi where primSvrha_id=:primSvrha_id
								   and id!=:id and zupa_id=:zupa_id;");
		$izraz->bindParam(':primSvrha_id', $_POST["primSvrha_id"]);
		$izraz->bindParam(':id', $_POST["id"]);
		$izraz->bindParam(':zupa_id', $_POST["zupa_id"]);
		$izraz -> execute();
		$automatika = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($automatika)){
			$porukaGreske = "Ta primarna svrha je već pridružena";
			}
