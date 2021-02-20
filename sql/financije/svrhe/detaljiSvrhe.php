<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from svrhe where id=:id and zupa_id=:zupa_id");
	$izraz -> bindParam(':id', $_GET["id"]);	
	$izraz -> bindParam(':zupa_id', $_GET["zupa_id"]);	
	$izraz -> execute();
	$svrha = $izraz -> fetch(PDO::FETCH_OBJ);