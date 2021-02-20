<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("update grupe set nazivGrupe=:grupa where id=:id");
	$izraz -> execute($_POST);
	
	header ('location:' . $putanjaApp . 'admin/financije/grupe/grupe.php');
	
