<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("update svrhe set nazivSvrhe=:svrha,grupa_id=:grupa_id where id=:id and zupa_id is null;");
	$izraz -> execute($_POST);
	header ('location:' . $putanjaApp . 'admin/financije/svrhe/svrhe.php');
