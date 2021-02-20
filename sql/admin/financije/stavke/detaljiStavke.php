<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from stavke where id=:id;");
	$izraz -> bindParam(':id', $_GET["id"]);	
	$izraz -> execute();
	$stavka = $izraz -> fetch(PDO::FETCH_OBJ);