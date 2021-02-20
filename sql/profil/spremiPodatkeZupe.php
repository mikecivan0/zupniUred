<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("update zupe set nazivZupe=:nazivZupe,adresaUreda=:adresaUreda,telefon=:telefon,
						   printer_id=:hfPrinterId,mjesto_id=:hfMjestoId where id=:id");
	$izraz -> bindParam(':nazivZupe', $_POST["nazivZupe"]);
	$izraz -> bindParam(':adresaUreda', $_POST["adresaUreda"]);
	$izraz -> bindParam(':telefon', $_POST["telefon"]);
	$izraz -> bindParam(':hfPrinterId', $_POST["hfPrinterId"]);
	$izraz -> bindParam(':hfMjestoId', $_POST["hfMjestoId"]);
	$izraz -> bindParam(':id', $_GET["id"]);
	$izraz -> execute();