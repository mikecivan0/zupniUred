<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	$izraz = $veza -> prepare("insert into automatskiUnosi(autoSvrha_id,primSvrha_id,zupa_id) values(:autoSvrha_id,:primSvrha_id,:zupa_id);");
	$izraz -> execute($_POST);
	header ('location:' . $putanjaApp . 'financije/automatike/automatike.php?id=' . $_GET["id"]);
}
