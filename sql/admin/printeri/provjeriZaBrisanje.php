<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	
	$izraz = $veza -> prepare("select distinct nazivZupe from zupe where printer_id=:id limit 20");
	$izraz -> execute($_GET);
	$zupe= $izraz -> fetchAll(PDO::FETCH_OBJ);
