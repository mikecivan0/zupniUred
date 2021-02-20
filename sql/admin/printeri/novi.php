<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	$izraz = $veza -> prepare("insert into printeri(nazivPrintera) values(:nazivPrintera)");
	$izraz -> execute($_POST);
	header ('location:' . $putanjaApp . 'admin/printeri/index.php');
}
