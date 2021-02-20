<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("update kalkulacije set svrha_id=:svrha_id,stavka_id=:stavka_id 
							   where id=:id and zupa_id=:zupa_id;");
	$izraz -> bindParam(':svrha_id', $_POST["svrha_id"]);
	$izraz -> bindParam(':stavka_id', $_POST["stavka_id"]);
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz -> bindParam(':zupa_id', $_POST["zupa_id"]);
	$izraz -> execute();
	
	header ('location:' . $putanjaApp . 'financije/kalkulacije/kalkulacije.php?id=' . $_POST["zupa_id"]);
	
