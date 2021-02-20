<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	
	if(strlen(trim($_POST["hfPrinterId"]))==0){
		$_POST["hfPrinterId"] = 1;
	}
	
	if(strlen(trim($_POST["adresaUreda"]))==0){
		$_POST["adresaUreda"] = "nepoznata adresa";
	}
	
	$izraz = $veza -> prepare("insert into zupe(nazivZupe,adresaUreda,telefon,biskupija_id,mjesto_id,printer_id) 
								values(:nazivZupe,:adresaUreda,:telefon,:biskupija_id,:mjesto_id,:printer_id)");
	$izraz -> bindParam(":nazivZupe", $_POST["nazivZupe"]);
	$izraz -> bindParam(":adresaUreda", $_POST["adresaUreda"]);
	$izraz -> bindParam(":telefon", $_POST["telefon"]);
	$izraz -> bindParam(":biskupija_id", $_POST["hfBiskupijaId"]);
	$izraz -> bindParam(":mjesto_id", $_POST["hfMjestoId"]);	
	$izraz -> bindParam(":printer_id", $_POST["hfPrinterId"]);	
	$izraz -> execute();
	header ('location:' . $putanjaApp . 'admin/zupe/index.php');
}
