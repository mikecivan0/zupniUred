<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("select * from zupe where id=:id");
	$izraz -> bindParam(":id", $_POST["hfZupaId"]);
	$izraz -> execute();
	$zupa = $izraz -> fetch(PDO::FETCH_OBJ);
	