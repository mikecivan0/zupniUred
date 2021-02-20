<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	unset($_POST['passwordAgain']);
	$_POST["password"] = md5($_POST["password"]);
	$_POST["istekLicence"] = (empty($_POST["istekLicence"])) ? null : $_POST["istekLicence"];	
	$izraz = $veza -> prepare("insert into users(osoba_id,username,password,razina,aktivan,istekLicence) 
										   values(:osoba_id,:username,:password,:razina,1,:istekLicence)");
	$izraz -> execute($_POST);
	header ('location:' . $putanjaApp . 'admin/users/detalji.php?id=' . $veza->lastInsertId());
}
