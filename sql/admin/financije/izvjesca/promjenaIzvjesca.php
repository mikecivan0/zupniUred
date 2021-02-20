<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("update izvjesca set nazivIzvjesca=:izvjesce where id=:id;");
	$izraz -> execute($_POST);
	
	header ('location:' . $putanjaApp . 'admin/financije/izvjesca/izvjesca.php');
	
