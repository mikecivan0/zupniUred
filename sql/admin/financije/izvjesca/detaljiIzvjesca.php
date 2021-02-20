<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from izvjesca where id=:id;");
	$izraz -> bindParam(':id', $_GET["id"]);	
	$izraz -> execute();
	$izvjesce = $izraz -> fetch(PDO::FETCH_OBJ);