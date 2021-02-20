<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from biskupije");
	$izraz -> execute();
	$biskupije = $izraz -> fetchAll(PDO::FETCH_OBJ);