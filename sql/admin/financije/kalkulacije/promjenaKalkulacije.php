<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("update kalkulacije set svrha_id=:svrha_id,stavka_id=:stavka_id 
							   where id=:id and zupa_id is null;");
	$izraz -> execute($_POST);
	
	header ('location:' . $putanjaApp . 'admin/financije/kalkulacije/kalkulacije.php');
	
