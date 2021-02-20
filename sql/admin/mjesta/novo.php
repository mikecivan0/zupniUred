<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	$izraz = $veza -> prepare("insert into mjesta(nazivMjesta,pbr) values(:nazivMjesta,:pbr)");
	$izraz -> execute($_POST);
	header ('location:' . $putanjaApp . 'admin/mjesta/index.php');
}
