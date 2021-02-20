<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($printerId)){
	$id = $printerId;
}elseif(isset($_POST["drugiPrinterSelect"])){
	$id = $_POST["drugiPrinterSelect"];
}
	$izraz = $veza -> prepare("select * from printeri where id=:id");
	$izraz -> bindParam(":id", $id);
	$izraz -> execute();
	$printer = $izraz -> fetch(PDO::FETCH_OBJ);
	