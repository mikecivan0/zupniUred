<?php
	if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	if(!isset($_POST)){
		exit;
	}
	
	$izraz = $veza -> prepare("delete from zupe where id=:id");
	$izraz -> execute($_POST);
	
	header('location: ' . $putanjaApp . 'admin/zupe/index.php');