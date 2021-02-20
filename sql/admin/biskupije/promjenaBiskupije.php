<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("update biskupije set nazivBiskupije=:biskupija where id=:id");
	$izraz -> execute($_POST);
	
	header ('location:' . $putanjaApp . 'admin/biskupije/index.php');
