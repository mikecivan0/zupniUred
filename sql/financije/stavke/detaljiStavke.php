<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from stavke where id=:id and zupa_id=:zupa_id;");
	$izraz -> bindParam(':id', $_GET["stavka_id"]);	
	$izraz -> bindParam(':zupa_id', $_GET["id"]);	
	$izraz -> execute();
	$stavka = $izraz -> fetch(PDO::FETCH_OBJ);