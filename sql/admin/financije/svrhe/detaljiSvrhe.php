<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from svrhe where id=:id and zupa_id is null;");
	$izraz -> bindParam(':id', $_GET["id"]);	
	$izraz -> execute();
	$svrha = $izraz -> fetch(PDO::FETCH_OBJ);
	