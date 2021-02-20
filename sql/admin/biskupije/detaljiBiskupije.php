<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from biskupije where id=:id");
	$izraz -> bindParam(':id', $_GET["id"]);	
	$izraz -> execute();
	$biskupija = $izraz -> fetch(PDO::FETCH_OBJ);