<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	$izraz = $veza -> prepare("insert into biskupije(nazivBiskupije) values(:nazivBiskupije)");
	$izraz -> execute($_POST);
	header ('location:' . $putanjaApp . 'admin/biskupije/index.php');
}
