<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from grupe where id=:id");
	$izraz -> bindParam(':id', $_GET["id"]);	
	$izraz -> execute();
	$grupa = $izraz -> fetch(PDO::FETCH_OBJ);