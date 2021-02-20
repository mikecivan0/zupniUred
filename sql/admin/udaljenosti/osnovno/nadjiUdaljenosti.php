<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

	$izraz = $veza -> prepare("select * from vrsteDokumenata where id=:id");	
	$izraz->bindParam(':id', $_GET["vrstaDokumenta"]);	
	$izraz -> execute();
	$objDokument= $izraz -> fetch(PDO::FETCH_OBJ);
	
