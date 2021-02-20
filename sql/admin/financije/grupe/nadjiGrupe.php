<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from grupe;");
	$izraz -> execute();
	$grupe = $izraz -> fetchAll(PDO::FETCH_OBJ);