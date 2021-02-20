<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from izvjesca;");
	$izraz -> execute();
	$izvjesca = $izraz -> fetchAll(PDO::FETCH_OBJ);