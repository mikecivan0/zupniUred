<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$sql = "select * from printeri where id=:id";
	$izraz = $veza -> prepare($sql);
	$izraz -> bindParam(":id", $_POST["hfPrinterIdZaSpremanjeUdaljenosti"]);
	$izraz -> execute();
	$objUdaljenosti = $izraz -> fetch(PDO::FETCH_OBJ);
	
