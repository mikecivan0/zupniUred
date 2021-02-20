<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	$izraz = $veza -> prepare("insert into kalkulacije(stavka_id,svrha_id) values(:stavka_id,:svrha_id);");
	$izraz -> execute($_POST);
	header ('location:' . $putanjaApp . 'admin/financije/kalkulacije/kalkulacije.php');
}
