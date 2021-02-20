<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	$izraz = $veza -> prepare("insert into izvjesca(nazivIzvjesca) values(:nazivIzvjesca);");
	$izraz -> execute($_POST);
	header ('location:' . $putanjaApp . 'admin/financije/izvjesca/izvjesca.php');
}
