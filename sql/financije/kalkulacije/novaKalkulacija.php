<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	$izraz = $veza -> prepare("insert into kalkulacije(stavka_id,svrha_id,zupa_id) values(:stavka_id,:svrha_id,:zupa_id);");
	$izraz -> bindParam(':stavka_id', $_POST["stavka_id"]);
	$izraz -> bindParam(':svrha_id', $_POST["svrha_id"]);
	$izraz -> bindParam(':zupa_id', $_GET["id"]);
	$izraz -> execute();
	header ('location:' . $putanjaApp . 'financije/kalkulacije/kalkulacije.php?id=' . $_GET["id"]);
}
