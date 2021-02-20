<?php
	if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	
	if(!isset($_POST)){
		exit;
	}
	
	$izraz = $veza -> prepare("delete from osobe where id=:id");
	$izraz -> execute($_POST);
	
	header('location: ' . $putanjaApp . 'admin/osobe/index.php');